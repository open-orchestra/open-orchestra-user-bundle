<?php

namespace PHPOrchestra\UserBundle\DisplayBlock;

use PHPOrchestra\DisplayBundle\DisplayBlock\Strategies\AbstractStrategy;
use PHPOrchestra\ModelBundle\Model\BlockInterface;
use Symfony\Component\Form\Extension\Csrf\CsrfProvider\CsrfTokenManagerAdapter;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class LoginStrategy
 */
class LoginStrategy extends AbstractStrategy
{
    const LOGIN = 'login';

    protected $tokenManager;

    /**
     * @param CsrfTokenManagerAdapter $tokenManager
     */
    public function __construct(CsrfTokenManagerAdapter $tokenManager)
    {
        $this->tokenManager = $tokenManager;
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
        return $this->render(
            'PHPOrchestraUserBundle:Security:loginForm.html.twig',
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
