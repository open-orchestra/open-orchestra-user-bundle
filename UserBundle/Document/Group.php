<?php

namespace OpenOrchestra\UserBundle\Document;

use FOS\UserBundle\Model\Group as BaseGroup;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use OpenOrchestra\Mapping\Annotations as ORCHESTRA;

/**
 * @ODM\Document(
 *  collection="users_group",
 *  repositoryClass="OpenOrchestra\UserBundle\Repository\GroupRepository"
 * )
 */
class Group extends BaseGroup
{
    /**
     * @ORCHESTRA\Search(key="name")
     */
    protected $name;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->roles = array();
    }

    /**
     * @ODM\Id(strategy="auto")
     */
    protected $id;
}
