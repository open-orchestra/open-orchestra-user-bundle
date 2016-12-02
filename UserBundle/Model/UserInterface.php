<?php

namespace OpenOrchestra\UserBundle\Model;

use FOS\UserBundle\Model\UserInterface as BaseUserInterface;
use FOS\UserBundle\Model\GroupableInterface;

/**
 * Interface UserInterface
 */
interface UserInterface extends BaseUserInterface, GroupableInterface
{
    const ENTITY_TYPE = 'user';

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

    /**
     * @param string $siteId
     * @param string $language
     */
    public function setLanguageBySite($siteId, $language);

    /**
     * @param string $aliasId
     *
     * @return bool
     */
    public function hasLanguageBySite($siteId);

    /**
     * @return array
     */
    public function getLanguageBySites();

    /**
     * @param bool $editAllowed
     */
    public function setEditAllowed($editAllowed);

    /**
     * @return bool
     */
    public function isEditAllowed();
}
