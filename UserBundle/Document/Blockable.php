<?php

namespace OpenOrchestra\UserBundle\Document;

/**
 * Trait Blockable
 */
trait Blockable
{
    /**
     * @var boolean $blocked
     *
     * @ODM\Field(type="boolean")
     */
    protected $blocked;

    /**
     * @return boolean
     */
    public function isBlocked()
    {
        return $this->blocked;
    }

    /**
     * @param boolean $blocked
     */
    public function setBlocked($blocked)
    {
        $this->blocked = $blocked;
    }

    /**
     * {@inheritdoc}
     */
    public function block()
    {
        $this->blocked = true;
    }

    /**
     * {@inheritdoc}
     */
    public function unblock()
    {
        $this->blocked = false;
    }
}
