<?php

namespace App\Form;

use App\Entity\Escritorio;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
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
            ])

            ->add('phone')
            ->add('celular')
            ->add('descricao')
            ->add('cep')
            ->add('endereco')
            ->add('numero')
            ->add('complemento')
            ->add('bairro')
            ->add('cidade')
            ->add('uf')
            ->add('office_company',null,[
                'choice_label'=>function($company) {
                    return $company->getId().' - '. $company->getNome();
                }
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
