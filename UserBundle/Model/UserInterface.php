<?php

namespace OpenOrchestra\UserBundle\Model;

use FOS\UserBundle\Model\UserInterface as BaseUserInterface;
use FOS\UserBundle\Model\GroupableInterface;

/**
 * Interface UserInterface
 */
interface UserInterface extends BaseUserInterface, GroupableInterface
{
    /**
     * @return string
     */
    public function getLastName();

    /**
     * @return string
     */
    public function getFirstName();

    /**
     * @return string
     */
    public function getLanguage();

    /**
     * @param string $lastName
     */
    public function setLastName($lastName);

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName);

    /**
     * @param string $language
     */
    public function setLanguage($language);
}
