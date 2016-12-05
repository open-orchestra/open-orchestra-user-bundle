<?php

namespace OpenOrchestra\UserBundle\Repository;

use Solution\MongoAggregation\Pipeline\Stage;
use OpenOrchestra\Repository\ReferenceAggregateFilterTrait;
use OpenOrchestra\Pagination\Configuration\PaginateFinderConfiguration;
use OpenOrchestra\Repository\AbstractAggregateRepository;
use FOS\UserBundle\Model\GroupInterface;
use OpenOrchestra\ModelInterface\Model\RoleInterface;
use OpenOrchestra\UserBundle\Model\UserInterface;

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
     * @param RoleInterface $role
     *
     * @return bool
     */
    public function hasElementWithRole(RoleInterface $role)
    {
        $qa = $this->createAggregationQuery();
        $qa->match(array('roles' => $role->getName()));
        $user = $this->singleHydrateAggregateQuery($qa);

        return $user instanceof UserInterface;
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
     * @return int
     */
    public function count()
    {
        $qa = $this->createAggregationQuery();

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
     * @param Stage                       $qa
     *
     * @return array
     */
    protected function filterSearch(PaginateFinderConfiguration $configuration, Stage $qa)
    {
        $search = $configuration->getSearchIndex('search');
        if (null !== $search && $search !== '') {
            $filter = array('$or' =>array(
                array('username' => new \MongoRegex('/.*'.$search.'.*/i')),
                $this->getReferenceFilter('groups', array('name' => new \MongoRegex('/.*'.$search.'.*/i')))
            ));
            $qa->match($filter);
        }

        return $qa;
    }
}
