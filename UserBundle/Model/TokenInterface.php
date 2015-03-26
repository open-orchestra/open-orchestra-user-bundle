<?php

namespace OpenOrchestra\UserBundle\Model;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class TokenInterface
 */
interface TokenInterface extends BlockableInterface, ExpireableInterface
{
    /**
     * @return string
     */
    public function getCode();

    /**
     * @param string $code
     */
    public function setCode($code);

    /**
     * @return ApiClientInterface
     */
    public function getClient();

    /**
     * @param ApiClientInterface $client
     */
    public function setClient(ApiClientInterface $client);

    /**
     * @return UserInterface
     */
    public function getUser();

    /**
     * @param UserInterface $user
     */
    public function setUser(UserInterface $user);

    /**
     * @param UserInterface      $user
     * @param ApiClientInterface $client
     *
     * @return TokenInterface
     */
    public static function create(UserInterface $user = null, ApiClientInterface $client);
}
