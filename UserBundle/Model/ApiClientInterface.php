<?php

namespace OpenOrchestra\UserBundle\Model;

/**
 * Interface ApiClientInterface
 */
interface ApiClientInterface extends BlockableInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @param string $key
     */
    public function setKey($key);

    /**
     * @return string
     */
    public function getKey();

    /**
     * @param string $name
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $secret
     */
    public function setSecret($secret);

    /**
     * @return string
     */
    public function getSecret();

    /**
     * @param bool $trusted
     */
    public function setTrusted($trusted);

    /**
     * @return bool
     */
    public function isTrusted();
}
