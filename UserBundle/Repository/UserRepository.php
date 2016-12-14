<?php

namespace OpenOrchestra\UserBundle\Repository;

use Solution\MongoAggregation\Pipeline\Stage;
use OpenOrchestra\Repository\ReferenceAggregateFilterTrait;
use OpenOrchestra\Pagination\Configuration\PaginateFinderConfiguration;
use OpenOrchestra\Repository\AbstractAggregateRepository;
use FOS\UserBundle\Model\GroupInterface;

/**
 * Class UserRepository
 */
class UserRepository extends AbstractAggregateRepository implements UserRepositoryInterface
{
    use ReferenceAggregateFilterTrait;

    /**
     * @param string $username
     *
     * @return \OpenOrchestra\UserBundle\Document\User
     */
    public function findOneByUsername($username)
    {
        return $this->findOneBy(array('username' => $username));
    }

    /**
     * @param string $email
     *
     * @return \OpenOrchestra\UserBundle\Document\User
     */
    public function findOneByEmail($email)
    {
        return $this->findOneBy(array('email' => $email));
    }

    /**
     * @param string GroupInterface $group
     *
     * @return array
     */
    public function findByGroup(GroupInterface $group)
    {
        return $this->findBy(array('groups.$id' => new \MongoId($group->getId())));
    }

    /**
     * @param string string         $username
     * @param string GroupInterface $group
     *
     * @return array
     */
    public function findByIncludedUsernameWithoutGroup($username, GroupInterface $group)
    {
        $qb = $this->createQueryBuilder();
        $qb->field('groups.$id')->notEqual(new \MongoId($group->getId()));
        $qb->field('username')->equals(new \MongoRegex('/.*'.$username.'.*/i'));

        return $qb->getQuery() ->execute();
    }

    /**
     * @param PaginateFinderConfiguration $configuration
     *
     * @return array
     */
    public function findForPaginate(PaginateFinderConfiguration $configuration)
    {
        $qa = $this->createAggregationQuery();

        $this->filterSearch($configuration, $qa);

        $order = $configuration->getOrder();
        if (!empty($order)) {
            $qa->sort($order);
        }

        $qa->skip($configuration->getSkip());
        $qa->limit($configuration->getLimit());

        return $this->hydrateAggregateQuery($qa);
    }

    /**
     * @param PaginateFinderConfiguration $configuration
     * @param array                       $siteIds
     *
     * @return array
     */
    public function findForPaginateFilterBySiteIds(PaginateFinderConfiguration $configuration, array $siteIds)
    {
        $qa = $this->createAggregationQuery();

        $this->filterSearchAndSiteIds($configuration, $siteIds, $qa);

        $order = $configuration->getOrder();
        if (!empty($order)) {
            $qa->sort($order);
        }

        $qa->skip($configuration->getSkip());
        $qa->limit($configuration->getLimit());

        return $this->hydrateAggregateQuery($qa);
    }

    /**
     * @return int
     */
    public function count()
    {
        $qa = $this->createAggregationQuery();

        return $this->countDocumentAggregateQuery($qa);
    }

    /**
     * @param array $siteIds
     *
     * @return int
     */
    public function countFilterBySiteIds(array $siteIds)
    {
        $qa = $this->createAggregationQuery();
        $qa->match($this->getReferenceFilter('groups', $this->generateFilterSiteId($siteIds)));

        return $this->countDocumentAggregateQuery($qa);
    }

    /**
     * @param PaginateFinderConfiguration $configuration
     *
     * @return int
     */
    public function countWithFilter(PaginateFinderConfiguration $configuration)
    {
        $qa = $this->createAggregationQuery();
        $this->filterSearch($configuration, $qa);

        return $this->countDocumentAggregateQuery($qa);
    }

    /**
     * @param PaginateFinderConfiguration $configuration
     * @param array                       $siteIds
     *
     * @return int
     */
    public function countWithFilterAndSiteIds(PaginateFinderConfiguration $configuration, array $siteIds)
    {
        $qa = $this->createAggregationQuery();
        $this->filterSearchAndSiteIds($configuration, $siteIds, $qa);

        return $this->countDocumentAggregateQuery($qa);
    }

    /**
     * @param array $userIds
     *
     * @throws \Doctrine\ODM\MongoDB\MongoDBException
     */
    public function removeUsers(array $userIds)
    {
        $userMongoIds = array();
        foreach ($userIds as $userId) {
            $userMongoIds[] = new \MongoId($userId);
        }

        $qb = $this->createQueryBuilder();
        $qb->remove()
           ->field('id')->in($userMongoIds)
           ->getQuery()
           ->execute();
    }

    /**
     * @param array $groupIds
     *
     * @return array
     */
    public function getCountsUsersByGroups(array $groupIds) {
        array_walk($groupIds, function(&$item) {$item = new \MongoId($item);});
        $qa = $this->createAggregationQuery();
        $qa->match(array('groups.$id' => array('$in' => $groupsId)));
        $qa->project(array('_id' => 0, 'groups' => 1));
        $qa->unwind('$groups');
        $qa->match(array('groups.$id' => array('$in' => $groupIds)));
        $qa->group(array('_id' => '$groups', 'sum' => array('$sum' => 1)));
        $qa->project(array('_id' => 0, 'groups' => '$_id', 'sum' => 1));

        $aggregateGroupUsers = $qa->getQuery()->aggregate()->toArray();
        $nbrGroupsUsers = array();
        array_walk($aggregateGroupUsers, function($item) use (&$nbrGroupsUsers) {
            $groupId = $item['groups']['$id']->{'$id'};
            $nbrGroupsUsers[$groupId] = $item['sum'];
        });

        return $nbrGroupsUsers;
    }

    /**
     * @param PaginateFinderConfiguration $configuration
     * @param array                       $siteIds
     * @param Stage                       $qa
     *
     * @return array
     */
    protected function filterSearchAndSiteIds(PaginateFinderConfiguration $configuration, array $siteIds, Stage $qa)
    {
        $groupFilter = $this->generateFilterSiteId($siteIds);

        $search = $configuration->getSearchIndex('search');
        if (null !== $search && $search !== '') {
            $filter = $this->generateFilterSearch($search, $groupFilter);
        } else {
            $filter = $this->getReferenceFilter('groups', $groupFilter);
        }

        $qa->match($filter);

        return $qa;
    }

    /**
     * @param PaginateFinderConfiguration $configuration
     * @param Stage                       $qa
     *
     * @return array
     */
    protected function filterSearch(PaginateFinderConfiguration $configuration, Stage $qa)
    {
        $search = $configuration->getSearchIndex('search');
        if (null !== $search && $search !== '') {
            $filter = $this->generateFilterSearch($search);
            $qa->match($filter);
        }

        return $qa;
    }

    /**
     * @param string $search
     * @param array  $groupFilter
     *
     * @return array
     */
    protected function generateFilterSearch($search, $groupFilter = array())
    {
        $groupFilter['name'] = new \MongoRegex('/.*'.$search.'.*/i');
        return array('$or' =>array(
            array('username' => new \MongoRegex('/.*'.$search.'.*/i')),
            $this->getReferenceFilter('groups', $groupFilter)
        ));
    }

    /**
     * @param array $siteIds
     *
     * @return array
     */
    protected function generateFilterSiteId(array $siteIds)
    {
        array_walk($siteIds, function(&$item) {$item = new \MongoId($item);});

        return array('site.$id' => array('$in' => $siteIds));
    }
}
