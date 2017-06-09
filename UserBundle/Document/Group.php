<?php

namespace OpenOrchestra\UserBundle\Document;

use FOS\UserBundle\Model\Group as BaseGroup;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * @ODM\Document(
 *  collection="users_group",
 *  repositoryClass="OpenOrchestra\UserBundle\Repository\GroupRepository"
 * )
 */
class Group extends BaseGroup
{
    CONST PREFIX_GROUP_NAME = "group-";

    /**
     * @ODM\Id(
     *  strategy="auto"
     * )
     */
    protected $id;

    /**
     * @param string
     */
    protected $name;

    /**
     * Constructor
     */
    public function __construct($roles = array())
    {
        parent::__construct(uniqid(self::PREFIX_GROUP_NAME), $roles);
    }
}
