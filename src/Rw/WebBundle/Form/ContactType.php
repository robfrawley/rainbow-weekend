<?php

namespace Rw\WebBundle\Form;

use Symfony\Component\Form\AbstractType,
    Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class ContactType
 */
class ContactType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', 
                [
                    'label'    => 'Full Name',
                    'required' => false,
                ]
            )
            ->add('email', 'text', 
                [
                    'label'    => 'Email Address',
                    'required' => false,
                ]
            )
            ->add('phone', 'text', 
                [
                    'label'    => 'Phone Number',
                    'required' => false,
                ]
            )
            ->add('message', 'textarea', 
                [
                    'label'    => 'Your Message',
                    'required' => false,
                ]
            )
            ->add('captcha', 'captcha', 
                [
                    'label'=> 'Security Code'
                ]
            )
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {}

    /**
     * @return string
     */
    public function getName()
    {
        return 'contact_type';
    }
}