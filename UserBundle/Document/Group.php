<?php

namespace OpenOrchestra\UserBundle\Document;

use FOS\UserBundle\Model\Group as BaseGroup;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * @ODM\Document(collection="group")
 */
class Group extends BaseGroup
{
    /**
     * @ODM\Id(strategy="auto")
     */
    protected $id;
}
