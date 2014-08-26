<?php

namespace PHPOrchestra\BackofficeBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use PHPOrchestra\BackofficeBundle\EventSubscriber\AddSubmitButtonSubscriber;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class ContentTypeType
 */
class ContentTypeType extends AbstractType
{
    protected $contentTypeClass;

    /**
     * @param string $contentTypeClass
     */
    public function __construct($contentTypeClass)
    {
        $this->contentTypeClass = $contentTypeClass;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('contentTypeId', 'text')
            ->add('name', 'text')
            ->add('version', 'text')
            ->add('status', 'orchestra_status');

        $builder->addEventSubscriber(new AddSubmitButtonSubscriber());
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => $this->contentTypeClass,
            )
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'content_type';
    }
}