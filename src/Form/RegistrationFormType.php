<?php

namespace App\Form;

use App\Entity\Usuario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

use Symfony\Component\Security\Core\Security;

class RegistrationFormType extends AbstractType
{

    private $security;

    public function __construct(Security $security)
    {
       $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')

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

            ->add('cnpj', TextType::class, [
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
                'mapped' => false,
                'label' => 'CNPJ',
            ],
            
            )
            ->add('nome', null, array(
                'mapped' => false,
                'label' => 'Nome da Empresa',
            ))

        ;
        $builder->addEventListener(FormEvents::POST_SET_DATA, [$this, 'onPostSetData']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Usuario::class,
        ]);
    }

    public function onPostSetData(FormEvent $formEvent)
    {
        $form = $formEvent->getForm();
        $user = $this->security->getUser();
        $userlogged = $formEvent->getData();
    }
}
