<?php

namespace App\Form;

use App\Entity\Exame;
use App\Entity\Medico;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Repository\MedicoRepository;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class ExameType extends AbstractType
{
    /**
     * @var $userSession TokenStorageInterface
     */
    private $userSession;

    function __construct(MedicoRepository $medicoRepository, TokenStorageInterface $sessionToken) {

        $this->medicosRepo = $medicoRepository;
        $this->userSession = $sessionToken;

    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dtExm', DateType::class, [
                'format' => 'dd MM yyyy',
                'label' => 'Data do Exame',
            ],)
            ->add('procRealizado', null, [
                'label' => 'Procedimento Realizado',
            ])
            ->add('observacao', null, [
                'label' => 'Observação',
            ])
            ->add('ordemExm',ChoiceType::class,[
                'choices'=> [
                    '1 - Inicial' => 'Inicial',
                    '2 - Sequencial' => 'Sequencial',
                ],
                'label' => 'Ordem do Exame',
            ])
            ->add('resultado',ChoiceType::class,[
                'choices'=> [
                    '1 - Normal' => 'Normal',
                    '2 - Alterado' => 'Alterado',
                    '3 - Estável' => 'Estavel',
                    '4 - Agravamento' => 'Agravamento',
                ]
            ])
            ->add('vencimento', DateType::class, [
                'format' => 'dd MM yyyy',
            ])
            ->add('medico', null,[
                'query_builder'=> function(MedicoRepository $repo) {
                    return $repo->createQueryBuilder('m')
                        ->andWhere('m.escritorio in (:escritorio)')
                        ->setParameters(array('escritorio' => $this->userSession->getToken()->getUser()->getOffice()[0]));
                },
                'choice_label' => function(Medico $medico) {                    
                    return $medico->getId(). '-' . $medico->getNome();                    
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Exame::class,
        ]);
    }
}
