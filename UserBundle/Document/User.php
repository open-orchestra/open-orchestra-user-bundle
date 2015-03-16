<?php

namespace OpenOrchestra\UserBundle\Document;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * Document User
 *
 * @MongoDB\Document(collection="user")
 */
class User extends BaseUser
{
    /**
     * @MongoDB\Id()
     */
    protected $id;

    /**
     * @var string $lastName
     */
    protected $lastName;

    /**
     * @var string $firstName
     */
    protected $firstName;

    /**
     * @var string $language
     */
    protected $language;

    /**
     * @MongoDB\ReferenceMany(targetDocument="FOS\UserBundle\Model\GroupInterface")
     */
    protected $groups;

    /**
     * Class constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->setEnabled(true);
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @param string $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }
}
