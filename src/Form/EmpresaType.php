<?php

namespace App\Form;

use App\Entity\Empresa;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmpresaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nome')
            ->add('cep')
            ->add('endereco')
            ->add('numero')
            ->add('complemento')
            ->add('bairro')
            ->add('cidade')
            ->add('uf')
            ->add('phone')
            ->add('celular')
            ->add('descricao')
            ->add('email')
            ->add('cpf_responsavel')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Empresa::class,
        ]);
    }
}
