<?php

namespace App\Form;

use App\Entity\Exame;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dtExm')
            ->add('procRealizado')
            ->add('observacao')
            ->add('ordemExm')
            ->add('resultado')
            ->add('vencimento')
            ->add('medico', null,[
                'choice_label' => function($medico) {
                    return $medico->getId(). '-' . $medico->getNome();
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Exame::class,
        ]);
    }
}
