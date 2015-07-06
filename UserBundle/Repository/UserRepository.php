<?php

namespace OpenOrchestra\UserBundle\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;
use OpenOrchestra\Pagination\MongoTrait\FilterTrait;
use OpenOrchestra\Pagination\MongoTrait\PaginationTrait;

/**
 * Class UserRepository
 */
class UserRepository extends DocumentRepository
{
    use PaginationTrait;
    use FilterTrait;

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
