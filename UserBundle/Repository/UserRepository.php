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
     * @param RoleInterface $status
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
