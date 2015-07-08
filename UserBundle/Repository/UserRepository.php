<?php

namespace OpenOrchestra\UserBundle\Repository;

use OpenOrchestra\Repository\AbstractAggregateRepository;
use OpenOrchestra\Pagination\MongoTrait\PaginationTrait;

/**
 * Class UserRepository
 */
class UserRepository extends AbstractAggregateRepository
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
}
