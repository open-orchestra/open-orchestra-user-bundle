<?php

namespace OpenOrchestra\UserBundle\Repository;

use OpenOrchestra\Repository\AbstractAggregateRepository;
use OpenOrchestra\Pagination\MongoTrait\PaginationTrait;
use FOS\UserBundle\Model\GroupInterface;
use OpenOrchestra\ModelInterface\Model\RoleInterface;
use OpenOrchestra\UserBundle\Model\UserInterface;

/**
 * Class UserRepository
 */
class UserRepository extends AbstractAggregateRepository implements UserRepositoryInterface
{
    use PaginationTrait;

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
}
