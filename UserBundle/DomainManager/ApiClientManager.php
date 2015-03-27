<?php
namespace OpenOrchestra\UserBundle\DomainManager;

use Doctrine\Common\Persistence\ObjectManager;
use OpenOrchestra\UserBundle\Document\ApiClient;

/**
 * Class ApiClientMananger
 */
class ApiClientManager
{
    /**
     * @var ObjectManager
     */
    private $om;

    /**
     * @var string
     */
    private $class;

    /**
     * @param ObjectManager $manager
     * @param string        $class
     */
    public function __construct(ObjectManager $manager, $class)
    {
        $this->om = $manager;
        $this->class = $class;
    }

    /**
     * Create a fresh object
     */
    public function create()
    {
        $apiClientClass = $this->class;
        return new $apiClientClass();
    }

    /**
     * @param int $id
     *
     * @return ApiClient
     */
    public function load($id)
    {
        $repository = $this->om->getRepository($this->class);

        return $repository->find($id);
    }
    /**
     * @param ApiClient $apiClient
     */
    public function save(ApiClient $apiClient)
    {
        $this->om->persist($apiClient);
        $this->om->flush();
    }

    /**
     * @param ApiClient $apiClient
     */
    public function delete(ApiClient $apiClient)
    {
        $this->om->remove($apiClient);
        $this->om->flush();
    }
}
