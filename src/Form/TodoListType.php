<?php

namespace App\Form;

use App\Entity\TodoList;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TodoListType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom',
                "attr" => [
                    "placeholder" => "Nom de la liste",
                ]

            ])
            ->add('description', TextareaType::class, [
                "attr" => [
                    "placeholder" => "Description de la liste",
                ]
            ])
            ->add('color', ColorType::class, [
                "label" => "Couleur",
                //"required" => false
            ])
            ->add('date', DateType::class, [
                'years' => range(date('Y'), date('Y') + 100),
            ])
            ->add('percent', RangeType::class, [
                'attr' => [
                    'min' => 0,
                    'max' => 100
                ],
                'data' => '0',
                'required' => false,
                'label' => 'Pourcentage',
                'label_attr' => [
                    'class' => 'form-label'
                ],
            ]);;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TodoList::class
        ]);
    }
}
