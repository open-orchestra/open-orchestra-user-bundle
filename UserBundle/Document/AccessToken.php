<?php

namespace OpenOrchestra\UserBundle\Document;

use OpenOrchestra\UserBundle\Model\ApiClientInterface;
use OpenOrchestra\UserBundle\Model\TokenInterface;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\ValidatorInterface;

/**
 * Class AccessToken
 *
 * @ODM\Document(
 *   collection="access_token",
 *   repositoryClass="OpenOrchestra\UserBundle\Repository\AccessTokenRepository"
 * )
 */
class AccessToken implements TokenInterface
{
    use Blockable;
    use Expireable;

    /**
     * @ODM\Id()
     */
    protected $id;

    /**
     * @var string $code
     *
     * @ODM\Field(type="string")
     */
    protected $code;

    /**
     * @var UserInterface $user
     *
     * @ODM\ReferenceOne(targetDocument="OpenOrchestra\UserBundle\Document\User")
     */
    protected $user;

    /**
     * @var ApiClientInterface $client
     *
     * @ODM\ReferenceOne(targetDocument="OpenOrchestra\UserBundle\Document\ApiClient")
     */
    protected $client;

    /**
     * @ODM\Date
     */
    protected $createdAt;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->code = $this->generateId();
        $this->createdAt = new \DateTime();
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Generate an unique Id
     *
     * @return string
     */
    public function generateId()
    {
        $data = unpack('H*', openssl_random_pseudo_bytes(32));

        return array_pop($data);
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return UserInterface
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param UserInterface $user
     */
    public function setUser(UserInterface $user = null)
    {
        $this->user = $user;
    }

    /**
     * @return ApiClientInterface
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param ApiClientInterface $client
     */
    public function setClient(ApiClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param UserInterface      $user
     * @param ApiClientInterface $client
     *
     * @return TokenInterface
     */
    public static function create(UserInterface $user = null, ApiClientInterface $client)
    {
        $accessToken = new self();
        $accessToken->setUser($user);
        $accessToken->setClient($client);

        return $accessToken;
    }

    /**
     * @param ValidatorInterface $validator
     *
     * @return boolean
     */
    public function isValid(ValidatorInterface $validator)
    {
        $this->violations = $validator->validate($this);

        return 0 === count($this->violations);
    }
}
