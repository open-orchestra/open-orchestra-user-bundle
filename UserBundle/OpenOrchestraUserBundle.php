<?php

namespace OpenOrchestra\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class OpenOrchestraUserBundle
 */
class OpenOrchestraUserBundle extends Bundle
{
    /**
     * @return string
     */
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
