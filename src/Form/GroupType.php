<?php

namespace App\Form;

use App\Entity\Group;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

class GroupType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Name', TextType::class, [
                'mapped' => true,
                'constraints' => [
                    new NotBlank(['message' => 'Pole Nazwa nie może być puste']),
                    new NotNull(['message' => 'Pole Nazwa nie może być puste'])
                ]
            ])
            ->add('Description', TextareaType::class, [
                'mapped' => true,
                'constraints' => [
                    new NotBlank(['message' => 'Pole Opis nie może być puste']),
                    new NotNull(['message' => 'Pole Opis nie może być puste'])
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Group::class,
        ]);
    }
}
