<?php

namespace OpenOrchestra\UserBundle\Repository;

use OpenOrchestra\UserBundle\Document\User;

/**
 * Class UserRepository
 */
class UserRepository extends AbstractRepository
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
