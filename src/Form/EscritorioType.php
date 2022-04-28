<?php

namespace App\Form;

use App\Entity\Escritorio;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class EscritorioType extends AbstractType
{

    private $route;

    public function __construct(RequestStack $requestStack) {

        $this->route = $requestStack->getCurrentRequest()->get('_route');
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nome')
            ->add('email')
            ->add('cnpj', null, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a CNPJ',
                    ]),
                    new Length([
                        'min' => 14,
                        'minMessage' => 'CNPJ have 14 digits',
                        'max' => 14,
                    ]),
                ],
                'label' => 'CNPJ',
            ])

            ->add('phone', null, [
                'label' => 'Telefone',
            ])
            ->add('celular')
            ->add('descricao', null, [
                'label' => 'Descrição',
            ])
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
            ->add('office_company',null,[
                'choice_label'=>function($company) {
                    return $company->getId().' - '. $company->getNome();
                },
                'label' => 'Empresa Associada',
            ])
            ;
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Escritorio::class,
        ]);
    }

    public function onPreSetData(FormEvent $formEvent)
    {
        $form = $formEvent->getForm();

        if (str_contains($this->route, 'app_escritorio'))
        {            
            $form->add('endereco');
            $form->add('phone');
            $form->add('descricao');

            $form->add('office_company',null,[
                'choice_label'=>function($company) {
                    return $company->getId().' - '. $company->getNome();
                }
            ]);
        }
    }
}
