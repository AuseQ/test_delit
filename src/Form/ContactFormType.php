<?php

namespace App\Form;

use App\Entity\UserContact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('user_lastname', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'NOM*']
            ])
            ->add('user_firstname', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'PRENOM*']
            ])
            ->add('user_mail', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'EMAIL*']
            ])
            ->add('message', TextareaType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'MESSAGE*']
            ])
            ->add('user_phone_number', TelType::class,[
                'label' => false,
                'attr' => ['placeholder' => 'TÉLÉPHONE*']
            ])
            ->add('submit', SubmitType::class, [
                'label' =>  'ENVOYER'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserContact::class,
        ]);
    }
}
