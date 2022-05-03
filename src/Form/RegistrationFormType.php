<?php

namespace App\Form;

use App\Entity\Usuario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\HttpFoundation\RequestStack;

use Symfony\Component\Security\Core\Security;

class RegistrationFormType extends AbstractType
{

    private $security;

    public function __construct(Security $security, RequestStack $requestStack)
    {
       $this->security = $security;
       $this->route = $requestStack->getCurrentRequest()->get('_route');
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class)

            ->add('plainPassword', RepeatedType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'type' => PasswordType::class,
                'mapped' => false,
                'attr' => [ 'class' => 'password-field'],
                'invalid_message' => 'As senhas estão diferentes.',
                'required' => true,
                'first_options'  => ['label' => 'Senha'],
                'second_options' => ['label' => 'Confirmar Senha'],
            ])

            ->add('username',null, [
                'label' => 'Nome de Usuario',
            ])

            /*->add('office', null, [
                'choice_label' => function($company) {
                return $company->getNome();
                }
            ])*/


        ;
        $builder->addEventListener(FormEvents::PRE_SET_DATA, [$this, 'onPreSetData']);
        $builder->addEventListener(FormEvents::POST_SET_DATA, [$this, 'onPostSetData']);
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

        if ($this->route == 'app_register')
        {
            $form->add('cnpj', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a CNPJ',
                    ]),
                ],
                'attr' => ['minlength' => 14 , 'maxlength' => 14],
                'mapped' => false,
                'label' => 'CNPJ',
            ],
            
        );
            $form->add('nome', null, array(
                'mapped' => false,
                'label' => 'Nome da Empresa',
            ));
        }
    }

    public function onPostSetData(FormEvent $formEvent)
    {
        $form = $formEvent->getForm();
        $user = $this->security->getUser();
        $userlogged = $formEvent->getData();
    }
}
