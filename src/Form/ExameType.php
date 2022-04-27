<?php

namespace App\Form;

use App\Entity\Exame;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dtExm', DateType::class, [
                'format' => 'dd MM yyyy',
            ])
            ->add('procRealizado')
            ->add('observacao')
            ->add('ordemExm',ChoiceType::class,[
                'choices'=> [
                    '1 - Inicial' => 'Inicial',
                    '2 - Sequencial' => 'Sequencial',
                ]
            ])
            ->add('resultado',ChoiceType::class,[
                'choices'=> [
                    '1 - Normal' => 'Normal',
                    '2 - Alterado' => 'Alterado',
                    '3 - Estável' => 'Estavel',
                    '4 - Agravamento' => 'Agravamento',
                ]
            ])
            ->add('vencimento', DateType::class, [
                'format' => 'dd MM yyyy',
            ])
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
