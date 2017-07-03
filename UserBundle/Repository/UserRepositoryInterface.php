<?php

namespace OpenOrchestra\UserBundle\Repository;

use FOS\UserBundle\Model\GroupInterface;
use OpenOrchestra\Pagination\Configuration\PaginateFinderConfiguration;

/**
 * Interface UserRepositoryInterface
 */
interface UserRepositoryInterface
{
    /**
     * @param string $email
     *
     * @return \OpenOrchestra\UserBundle\Document\User
     */
    public function findOneByEmail($email);

    /**
     * @param string $username
     *
     * @return \OpenOrchestra\UserBundle\Document\User
     */
    public function findOneByUsername($username);

    /**
     * @param string GroupInterface $group
     *
     * @return array
     */
    public function findByGroup(GroupInterface $group);

    /**
     * @param PaginateFinderConfiguration $configuration
     * @param string                      $language
     *
     * @return array
     */
    public function findForPaginate(PaginateFinderConfiguration $configuration, $language);

    /**
     * @param PaginateFinderConfiguration $configuration
     * @param string                      $language
     * @param array                       $siteIds
     *
     * @return array
     */
    public function findForPaginateFilterBySiteIds(PaginateFinderConfiguration $configuration, $language, array $siteIds);

    /**
     * @return int
     */
    public function count();

    /**
     * @param array $siteIds
     *
     * @return int
     */
    public function countFilterBySiteIds(array $siteIds);

    /**
     * @param PaginateFinderConfiguration $configuration
     * @param string                      $language
     *
     * @return int
     */
    public function countWithFilter(PaginateFinderConfiguration $configuration, $language);

    /**
     * @param PaginateFinderConfiguration $configuration
     * @param string                      $language
     * @param array                       $siteIds
     *
     * @return int
     */
    public function countWithFilterAndSiteIds(PaginateFinderConfiguration $configuration, $language, array $siteIds);

    /**
     * @param array $userIds
     */
    public function removeUsers(array $userIds);

    /**
     * @param array $groupIds
     *
     * @return array
     */
    public function getCountsUsersByGroups(array $groupIds);

    /**
     * @param PaginateFinderConfiguration $configuration
     * @param string                      $groupId
     *
     * @return array
     */
    public function findUsersByGroupsForPaginate(PaginateFinderConfiguration $configuration, $groupId);

    /**
     * @param string $groupId
     *
     * @return int
     */
    public function countFilterByGroups($groupId);

    /**
     * @param string $userId
     * @param string $groupId
     *
     * @return array
     */
    public function removeGroup($userId, $groupId);

    /**
     * @param array          $users
     * @param GroupInterface $group
     */
    public function addGroup(array $users, GroupInterface $group);
}
