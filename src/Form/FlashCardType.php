<?php

namespace App\Form;

use App\Entity\FlashCard;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

class FlashCardType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Content', TextType::class, [
                'mapped' => true,
                'constraints' => [
                    new NotBlank(['message' => 'Pole Fiszka nie może być puste']),
                    new NotNull(['message' => 'Pole Tłumaczenie nie może być puste'])
                ]
            ])
            ->add('Translation', TextType::class, [
                'mapped' => true,
                'constraints' => [
                    new NotBlank(['message' => 'Pole Tłumaczenie nie może być puste']),
                    new NotNull(['message' => 'Pole Tłumaczenie nie może być puste'])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FlashCard::class,
        ]);
    }
}
