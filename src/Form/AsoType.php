<?php

namespace App\Form;

use App\Entity\Aso;
use App\Entity\Exame;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AsoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dtAso')
            ->add('tipo',ChoiceType::class,[
                'choices'=> [
                    '0 - Exame médico admissional' => 'Exame médico admissional',
                    '1 - Exame médico periódico' => 'Exame médico periódico',
                    '2 - Exame médico de retorno ao trabalho' => 'Exame médico de retorno ao trabalho',
                    '3 - Exame médico de mudança de função' => 'Exame médico de mudança de função',
                    '4 - Exame médico de monitoração pontual' => 'Exame médico de monitoração pontual',
                    '9 - Exame médico demissional' => 'Exame médico demissional',
                ]
            ])
            ->add('resultado',ChoiceType::class,[
                'choices'=> [
                    '1 - Apto' => 'Apto',
                    '2 - Inapto' => 'Inapto',
                ]
            ])
            ->add('empresa',null,[
                'choice_label'=>function($empresa) {
                    return $empresa->getId().' - '. $empresa->getNome();
                }
            ])
            ->add('funcionario',null,[
                'choice_label'=>function($funcionario) {
                    return $funcionario->getId().' - '. $funcionario->getNome();
                }
            ])
            ->add('medico_aso',null,[
                'choice_label'=>function($medico) {
                    return $medico->getId().' - '. $medico->getNome();
                }
            ])
            ->add('medico_pcmso',null,[
                'choice_label'=>function($medico) {
                    return $medico->getId().' - '. $medico->getNome();
                }
            ])
            ->add('exames', CollectionType::class, [
                'entry_type' => ExameType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Aso::class,
        ]);
    }
}
