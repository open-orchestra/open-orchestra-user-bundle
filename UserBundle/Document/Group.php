<?php

namespace OpenOrchestra\UserBundle\Document;

use FOS\UserBundle\Model\Group as BaseGroup;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document(collection="group")
 */
class Group extends BaseGroup
{
    /**
     * @MongoDB\Id(strategy="auto")
     */
    protected $id;
}