<?php

namespace OpenOrchestra\UserBundle\Event;

use FOS\UserBundle\Model\GroupInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class GroupEvent
 */
class GroupEvent extends Event
{
    protected $group;

    /**
     * @param GroupInterface $group
     */
    public function __construct(GroupInterface $group)
    {
        $this->group = $group;
    }

    /**
     * @return GroupInterface
     */
    public function getGroup()
    {
        return $this->group;
    }
}
