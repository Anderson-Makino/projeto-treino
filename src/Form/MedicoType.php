<?php

namespace App\Form;

use App\Entity\Medico;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MedicoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nome')
            ->add('email')
            ->add('crm')
            ->add('cpf')
            ->add('phone')
            ->add('celular')
            ->add('cep')
            ->add('endereco')
            ->add('numero')
            ->add('complemento')
            ->add('bairro')
            ->add('cidade')
            ->add('uf')
            ->add('company_id',null,[
                'choice_label'=>function($company) {
                    return $company->getId().' - '. $company->getNome();
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Medico::class,
        ]);
    }
}
