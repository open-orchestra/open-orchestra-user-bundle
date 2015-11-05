<?php

namespace OpenOrchestra\UserBundle\Controller;

use FOS\UserBundle\Controller\SecurityController as BaseSecurityController;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class SecurityController
 */
class SecurityController extends BaseSecurityController
{
    /**
     * Renders the login template with the given parameters. Overwrite this function in
     * an extended controller to provide additional data for the login template.
     *
     * @param array $data
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function renderLogin(array $data)
    {
        $response = new Response();
        $response->headers->add(array('X-Form-Type' => 'login'));

        return $this->render('FOSUserBundle:Security:login.html.twig', $data, $response);
    }
}
