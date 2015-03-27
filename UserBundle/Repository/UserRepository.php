<?php

namespace OpenOrchestra\UserBundle\Repository;

use Doctrine\ODM\MongoDB\DocumentRepository;
use OpenOrchestra\UserBundle\Document\User;

/**
 * Class UserRepository
 */
class UserRepository extends DocumentRepository
{
    /**
     * @param string $username
     *
     * @return User
     */
    public function findOneByUsername($username)
    {
        return $this->findOneBy(array('username' => $username));
    }
}
