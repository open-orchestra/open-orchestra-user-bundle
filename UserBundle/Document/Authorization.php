<?php

namespace OpenOrchestra\UserBundle\Document;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Inflector\Inflector;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use OpenOrchestra\WorkflowFunction\Model\WorkflowFunctionInterface;
use OpenOrchestra\UserBundle\Model\AuthorizationInterface;

/**
 * Description of Base Authorization
 *
 * @ODM\EmbeddedDocument
 */
class Authorization implements AuthorizationInterface
{
    /**
     * @var string $authorizationId
     *
     * @ODM\Field(type="string")
     */
    protected $authorizationId;

    /**
     * @var string $name
     *
     * @ODM\Field(type="string")
     */
    protected $name;

    /**
     * @var ArrayCollection $workflowFunctions
     *
     * @ODM\ReferenceMany(targetDocument="OpenOrchestra\WorkflowFunction\Model\WorkflowFunctionInterface")
     */
    protected $workflowFunctions;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->workflowFunctions = new ArrayCollection();
    }
    /**
     * Set authorizationId
     *
     * @param string $authorizationId
     */
    public function setAuthorizationId($authorizationId)
    {
        $this->authorizationId = $authorizationId;
    }

    /**
     * Get authorizationId
     *
     * @return string
     */
    public function getAuthorizationId()
    {
        return $this->authorizationId;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param WorkflowFunctionInterface $workflowFunction
     */
    public function setWorkflowFunctions(ArrayCollection $workflowFunctions)
    {
        $this->workflowFunctions = $workflowFunctions;
    }

    /**
     * @return ArrayCollection
     */
    public function getWorkflowFunctions()
    {
        return $this->workflowFunctions;
    }

    /**
     * Clone the element
     */
    public function __clone()
    {
        $this->workflowFunctions = new ArrayCollection();
    }
}
