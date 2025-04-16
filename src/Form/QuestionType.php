<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Question;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Security;

class QuestionType extends AbstractType
{
    private $security;
    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        if($this->security->isGranted('ROLE_ADMIN')){
            $builder
                ->add('image1')
                ->add('image2')
                ->add('image3')
                ->add('response')
                ->add('categories', EntityType::class, [
                    'class' => Category::class,
                    'choice_label' => 'name',
                    'required' => true,
                    'expanded' => true,
                    'multiple' => true,
                ])
                ->add('isValid', ChoiceType::class, [
                    'label' => 'La question est-elle valide ?',
                    'choices' => [
                        'oui' => true,
                        'non' => false,
                    ],
                    'expanded' => true,
                    'multiple' => false,
                ]);

        }else{
            $builder
                ->add('image1')
                ->add('image2')
                ->add('image3')
                ->add('response')
                ->add('categories', EntityType::class, [
                    'class' => Category::class,
                    'choice_label' => 'name',
                    'required' => true,
                    'expanded' => true,
                    'multiple' => true,
                ])
                ->add('isValid', HiddenType::class, [
                    'data' => false,
                ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Question::class,
        ]);
    }
}
