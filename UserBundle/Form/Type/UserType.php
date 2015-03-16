<?php

namespace OpenOrchestra\UserBundle\Form\Type;

use OpenOrchestra\UserBundle\EventSubscriber\AddSubmitButtonSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Class UserType
 */
class UserType extends AbstractType
{
    protected $translator;

    /**
     * @param TranslatorInterface $translator
     */
    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', 'text', array(
                'label' => 'open_orchestra_user.form.user.firstName'
            ))
            ->add('lastName', 'text', array(
                'label' => 'open_orchestra_user.form.user.lastName'
            ))
            ->add('email', 'text', array(
                'label' => 'open_orchestra_user.form.user.email'
            ))
            ->add('plainPassword', 'repeated', array(
                'type' => 'password',
                'options' => array('translation_domain' => 'FOSUserBundle'),
                'first_options' => array('label' => 'open_orchestra_user.form.user.password'),
                'second_options' => array('label' => 'open_orchestra_user.form.user.password_confirmation'),
                'invalid_message' => 'open_orchestra_user.form.user.password_mismatch',
            ))
            ->add('language', 'orchestra_language', array(
                'label' => 'open_orchestra_user.form.user.language'
            ))
            ->addEventSubscriber(new AddSubmitButtonSubscriber());
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OpenOrchestra\UserBundle\Document\User'
        ));
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'user';
    }

}
