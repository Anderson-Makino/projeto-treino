<?php

namespace App\Form;

use App\Entity\Medico;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MedicoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nome')
            ->add('email')
            ->add('crm', null, [
                'label' => 'CRM'
            ])
            ->add('cpf', null, [
                'label' => 'CPF',
            ])
            ->add('phone', null, [
                'label' => 'Telefone'
            ])
            ->add('celular')
            ->add('cep')
            ->add('endereco', null, [
                'label' => 'Endereço'
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
            ->add('escritorio',null,[
                'choice_label'=>function($escritorio) {
                    return $escritorio->getId().' - '. $escritorio->getNome();
                },
                'label' => 'Escritorio Associado',
                'expanded' => true,
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
