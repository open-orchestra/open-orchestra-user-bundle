<?php

namespace OpenOrchestra\UserBundle\DisplayBlock;

use OpenOrchestra\DisplayBundle\DisplayBlock\Strategies\AbstractStrategy;
use OpenOrchestra\ModelInterface\Model\BlockInterface;
use Symfony\Component\Form\Extension\Csrf\CsrfProvider\CsrfTokenManagerAdapter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class LoginStrategy
 */
class LoginStrategy extends AbstractStrategy
{
    const LOGIN = 'login';

    protected $tokenManager;
    protected $securityContext;

    /**
     * @param CsrfTokenManagerAdapter  $tokenManager
     * @param SecurityContextInterface $securityContext
     */
    public function __construct(CsrfTokenManagerAdapter $tokenManager, SecurityContextInterface $securityContext)
    {
        $this->tokenManager = $tokenManager;
        $this->securityContext = $securityContext;
    }

    /**
     * Check if the strategy support this block
     *
     * @param BlockInterface $block
     *
     * @return boolean
     */
    public function support(BlockInterface $block)
    {
        return self::LOGIN == $block->getComponent();
    }

    /**
     * Perform the show action for a block
     *
     * @param BlockInterface $block
     *
     * @return Response
     */
    public function show(BlockInterface $block)
    {
        if( ($user = $this->securityContext->getToken()->getUser()) instanceof UserInterface) {
            return $this->render('OpenOrchestraUserBundle:Security:userLogged.html.twig',array(
                'user' => $user,
            ));
        }

        return $this->render(
            'OpenOrchestraUserBundle:Security:loginForm.html.twig',
            array(
                'csrf_token' => $this->tokenManager->generateCsrfToken('authenticate'),
                'last_username' => ''
            )
        );
    }

    /**
     * Get the name of the strategy
     *
     * @return string
     */
    public function getName()
    {
        return 'login';
    }
}
