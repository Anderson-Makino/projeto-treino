<?php

namespace App\Form;

use App\Entity\Empresa;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmpresaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nome')
            ->add('cep')
            ->add('endereco', null, [
                'label' => 'Endereço',
            ])
            ->add('numero')
            ->add('complemento')
            ->add('bairro')
            ->add('cidade')
            ->add('uf', ChoiceType::class, [
                'choices' => [
                    'AC' => 'Acre', 'AL' => 'Alagoas', 'AP' => 'Amapá', 'AM' => 'Amazonas', 'BA' => 'Bahia', 'CE' => 'Ceara', 'DF' => 'Distrito Federal',
                    'ES' => 'Espirito Santos', 'GO' => 'Goiás', 'MA' => 'Maranhão', 'MT' => 'Minas Gerais', 'MS' => 'Mato Grosso do Sul', 'MG' => 'Mato Grosso', 
                    'PA' => 'Paraiba', 'PB' => 'Paraíba', 'PR' => 'Parana', 'PE' => 'Pernambuco', 'PI' => 'Piauí', 'RJ' => 'Rio de Janeiro', 
                    'RN' => 'Rio Grande do Norte', 'RS' => 'Rio Grande do Sul', 'RO' => 'Rondônia', 'RR' => 'Roraima', 'SC' => 'Santa Catarina', 'SP' => 'São Paulo', 
                    'SE' => 'Sergipe', 'TO' => 'Tocantins'
                ],
                'label' => 'UF',
            ])
            ->add('phone', null, [
                'label' => 'Telefone',
            ])
            ->add('celular')
            ->add('descricao', null, [
                'label' => 'Descrição',
            ])
            ->add('email')
            ->add('cpf_responsavel', null, [
                'label' => 'CPF do Responsavel',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Empresa::class,
        ]);
    }
}
