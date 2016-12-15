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
     * @param string string         $username
     * @param string GroupInterface $group
     *
     * @return array
     */
    public function findByIncludedUsernameWithoutGroup($username, GroupInterface $group);

    /**
     * @param PaginateFinderConfiguration $configuration
     *
     * @return array
     */
    public function findForPaginate(PaginateFinderConfiguration $configuration);

    /**
     * @param PaginateFinderConfiguration $configuration
     * @param array                       $siteIds
     *
     * @return array
     */
    public function findForPaginateFilterBySiteIds(PaginateFinderConfiguration $configuration, array $siteIds);

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
     *
     * @return int
     */
    public function countWithFilter(PaginateFinderConfiguration $configuration);

    /**
     * @param PaginateFinderConfiguration $configuration
     * @param array                       $siteIds
     *
     * @return int
     */
    public function countWithFilterAndSiteIds(PaginateFinderConfiguration $configuration, array $siteIds);

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
}
