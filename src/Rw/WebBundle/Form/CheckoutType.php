<?php

namespace Rw\WebBundle\Form;

use Symfony\Component\Form\AbstractType,
    Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class CheckoutType
 */
class CheckoutType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fullName', 'text', 
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
            ->add('cleanDate', 'date', 
                [
                    'label'    => 'Clean Date',
                    'required' => false,
                    'widget'   => 'single_text',
                    'format'   => 'MM/dd/yyyy'
                ]
            )
            ->add('addressLine01', 'text', 
                [
                    'label'    => 'Address',
                    'required' => false,
                ]
            )
            ->add('addressLine02', 'text', 
                [
                    'label'    => 'Apt/Suite # (Optional)',
                    'required' => false,
                ]
            )
            ->add('addressCity', 'text', 
                [
                    'label'    => 'City',
                    'required' => false,
                ]
            )
            ->add('addressState', 'text', 
                [
                    'label'    => 'State',
                    'required' => false,
                ]
            )
            ->add('addressZip', 'text', 
                [
                    'label'    => 'Zipcode',
                    'required' => false,
                ]
            )
            ->add('cardNumber', 'text', 
                [
                    'label'    => 'Card Number',
                    'required' => false,
                ]
            )
            ->add('cardExperation', 'text', 
                [
                    'label'    => 'Card Experation',
                    'required' => false
                ]
            )
            ->add('cardCvc', 'text', 
                [
                    'label'    => 'Card CVV Code',
                    'required' => false,
                ]
            )
            ->add('notes', 'textarea', 
                [
                    'label'    => 'Notes or Comments (Optional)',
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
        return 'checkout_type';
    }
}