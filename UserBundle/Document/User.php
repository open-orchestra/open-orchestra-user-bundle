<?php

namespace OpenOrchestra\UserBundle\Document;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use OpenOrchestra\UserBundle\Model\AuthorizationInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Document User
 *
 * @ODM\Document(
 *  collection="user",
 *  repositoryClass="OpenOrchestra\UserBundle\Repository\UserRepository"
 * )
 */
class User extends BaseUser
{
    /**
     * @ODM\Id()
     */
    protected $id;

    /**
     * @var string $lastName
     *
     * @ODM\Field(type="string")
     */
    protected $lastName;

    /**
     * @var string $firstName
     *
     * @ODM\Field(type="string")
     */
    protected $firstName;

    /**
     * @var string $language
     *
     * @ODM\Field(type="string")
     */
    protected $language;

    /**
     * @ODM\ReferenceMany(targetDocument="FOS\UserBundle\Model\GroupInterface")
     */
    protected $groups;

    /**
     * @ODM\EmbedMany(targetDocument="OpenOrchestra\UserBundle\Model\AuthorizationInterface")
     */
    protected $authorizations;

    /**
     * Class constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->authorizations = new ArrayCollection();
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
     * @return ArrayCollection
     */
    public function getAuthorizations()
    {
        return $this->authorizations;
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

    /**
     * @param AuthorizationInterface $authorization
     */
    public function addAuthorization(AuthorizationInterface $authorization)
    {
        $this->authorizations->add($authorization);
    }
}
