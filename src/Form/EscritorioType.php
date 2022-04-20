<?php

namespace App\Form;

use App\Entity\Escritorio;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\IntegerType;

class EscritorioType extends AbstractType
{

    public $route;

    public function __construct(RequestStack $requestStack) {

        $this->route = $requestStack->getCurrentRequest()->get('_route');
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nome')
            ->add('cnpj')
            ;
            $builder->addEventListener(FormEvents::PRE_SET_DATA, [$this, 'onPreSetData']);
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
