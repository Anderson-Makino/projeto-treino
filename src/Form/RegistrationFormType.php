<?php

namespace App\Form;

use App\Entity\Usuario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
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

            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])

            ->add('username')

            /*->add('office', null, [
                'choice_label' => function($company) {
                return $company->getNome();
                }
            ])*/

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
                'mapped' => false,
            ],
            
            )
            ->add('nome', null, array(
                'mapped' => false
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
