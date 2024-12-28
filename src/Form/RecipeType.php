<?php

namespace App\Form;

use App\Entity\Recip;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Title',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Enter the recipe title',
                ],
            ])
            ->add('slug', TextType::class, [
                'label' => 'Slug',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Enter a unique slug (e.g., my-recipe)',
                ],
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Content',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Enter the recipe content',
                    'rows' => 5,
                ],
            ])
            ->add('duration', IntegerType::class, [
                'label' => 'Duration (minutes)',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Enter the cooking time in minutes',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recip::class,
        ]);
    }
}
