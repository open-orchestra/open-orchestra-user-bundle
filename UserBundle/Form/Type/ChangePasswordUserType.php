<?php

namespace OpenOrchestra\UserBundle\Form\Type;

use OpenOrchestra\UserBundle\EventSubscriber\AddSubmitButtonSubscriber;
use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\ChangePasswordFormType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ChangePasswordUserType
 */
class ChangePasswordUserType extends ChangePasswordFormType
{
    private $class;

    /**
     * @param string $class The User class name
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder->addEventSubscriber(new AddSubmitButtonSubscriber());
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->class,
            'intention'  => 'change_password',
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'user_change_password';
    }
}
