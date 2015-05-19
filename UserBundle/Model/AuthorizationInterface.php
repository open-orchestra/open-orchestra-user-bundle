<?php

namespace OpenOrchestra\UserBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use OpenOrchestra\WorkflowFunction\Model\WorkflowFunctionInterface;

/**
 * Interface AuthorizationInterface
 */
interface AuthorizationInterface
{
    /**
     * @param string $authorizationId
     */
    public function setAuthorizationId($authorizationId);

    /**
     * @return string
     */
    public function getAuthorizationId();

    /**
     * @param WorkflowFunctionInterface $workflowFunction
     */
    public function addWorkflowFunction(WorkflowFunctionInterface $workflowFunction);

    /**
     * @return ArrayCollection
     */
    public function getWorkflowFunctions();
}
