<?php

namespace OpenOrchestra\UserBundle\Model;

use Doctrine\Common\Collections\ArrayCollection;
use OpenOrchestra\WorkflowFunction\Model\WorkflowFunctionInterface;

/**
 * Interface AuthorizationInterface
 */
interface AuthorizationInterface
{
    const NODE = 'node';
    /**
     * @param string $authorizationId
     */
    public function setAuthorizationId($authorizationId);

    /**
     * @return string
     */
    public function getAuthorizationId();

    /**
     * @param ArrayCollection $workflowFunctions
     */
    public function setWorkflowFunctions(ArrayCollection $workflowFunctions);

    /**
     * @return ArrayCollection
     */
    public function getWorkflowFunctions();
}
