<?php

namespace OpenOrchestra\UserBundle\Model;

/**
 * Interface BlockableInterface
 */
interface BlockableInterface
{
    /**
     * @param bool $blocked
     */
    public function setBlocked($blocked);

    /**
     * @return bool
     */
    public function isBlocked();

    /**
     * Block a client
     */
    public function block();

    /**
     * Unblock a client
     */
    public function unblock();
}
