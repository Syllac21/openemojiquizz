<?php

namespace App\Form;


use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ResponseUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('response1', TextType::class)
            ->add('response2', TextType::class)
            ->add('response3', TextType::class)
            ->add('response4', TextType::class)
            ->add('response5', TextType::class)
            ->add('id1', HiddenType::class)
            ->add('id2', HiddenType::class)
            ->add('id3', HiddenType::class)
            ->add('id4', HiddenType::class)
            ->add('id5', HiddenType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
