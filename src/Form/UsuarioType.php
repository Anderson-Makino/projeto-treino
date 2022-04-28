<?php

namespace App\Form;

use App\Entity\Escritorio;
use App\Entity\Usuario;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Security\Core\Security;

class UsuarioType extends AbstractType
{

    private $security;
    private $route;

    public function __construct(Security $security, RequestStack $requestStack)
    {
       $this->security = $security;
       $this->route = $requestStack->getCurrentRequest()->get('_route');
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('username', null, [
                'label' => 'Nome de Usuario',
            ])
            ->add('email')
            ->add('password', null, [
                'label' => 'Senha',
            ])
        ;
        $builder->addEventListener(FormEvents::PRE_SET_DATA, [$this, 'onPreSetData']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Usuario::class,
        ]);
    }

    public function onPreSetData(FormEvent $formEvent)
    {
        $form = $formEvent->getForm();
        $user = $this->security->getUser();

        if (in_array("ROLE_ADMIN", $user->getRoles()))
        {
            $form->add('roles', ChoiceType::class, [
                'choices' => ['ROLE_ADMIN' => 'ROLE_ADMIN', 'ROLE_USER' => 'ROLE_USER'],
                'expanded' => true,
                'multiple' => true,
                ]
            );
        }

        if ($this->route != 'app_register')
        {
            $form->add('office', EntityType::class, [
                'class' => Escritorio::class,
                'multiple' => true,
                'expanded' => true,
                /*'choice_label'=>function($company) {
                    return $company->getId(). '-' .$company->getNome();
                },*/
                'choice_label' => 'nome',
            ]);
        }
    }
}
