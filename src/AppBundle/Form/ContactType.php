<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ContactType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'First Name',
                'required' => true,
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Last Name',
                'required' => true,
            ])
            ->add('picture', FileType::class, [
                'data_class' => null,
                'label' => 'Upload a contact picture',
                'required' => false,
            ])
            ->add('birthday', BirthdayType::class, [
                'label' => 'Birthday',
                'format' => 'dd-MM-yyyy',
                'required' => false,
            ])
            ->add('phonenumber', TextType::class, [
                'label' => 'Phone',
                'required' => false,
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'required' => false,
            ])
            ->add('street', TextType::class, [
                'label' => 'Street',
                'required' => false,
            ])
            ->add('zip', TextType::class, [
                'label' => 'ZIP',
                'required' => false,
            ])
            ->add('city', TextType::class, [
                'label' => 'City',
                'required' => false,
            ])
            ->add('country', CountryType::class, [
                'label' => 'Country',
                'preferred_choices' => [
                    'DE', 'FR', 'NL', 'PL', 'GB',
                    'BE', 'DK', 'ES', 'IT'
                ],
                'required' => false,
            ]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Contact'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_contact';
    }


}
