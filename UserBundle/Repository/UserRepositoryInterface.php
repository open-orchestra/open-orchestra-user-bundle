<?php

namespace OpenOrchestra\UserBundle\Repository;

use FOS\UserBundle\Model\GroupInterface;
use OpenOrchestra\Pagination\Configuration\PaginateFinderConfiguration;
use OpenOrchestra\ModelInterface\Repository\RoleableElementRepositoryInterface;

/**
 * Interface UserRepositoryInterface
 */
interface UserRepositoryInterface extends RoleableElementRepositoryInterface
{
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
     * @param array                       $sitesId
     *
     * @return array
     */
    public function findForPaginateFilterBySiteIds(PaginateFinderConfiguration $configuration, array $sitesId);

    /**
     * @return int
     */
    public function count();

    /**
     * @param array $sitesId
     *
     * @return int
     */
    public function countFilterBySiteIds(array $sitesId);

    /**
     * @param PaginateFinderConfiguration $configuration
     *
     * @return int
     */
    public function countWithFilter(PaginateFinderConfiguration $configuration);

    /**
     * @param PaginateFinderConfiguration $configuration
     * @param array                       $sitesId
     *
     * @return int
     */
    public function countWithFilterAndSiteIds(PaginateFinderConfiguration $configuration, array $sitesId);

    /**
     * @param array $usersId
     */
    public function removeUsers(array $usersId);
}
