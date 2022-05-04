<?php

namespace App\Form;

use App\Entity\Aso;
use App\Entity\Exame;
use App\Repository\EmpresaRepository;
use App\Repository\FuncionarioRepository;
use App\Repository\MedicoRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class AsoType extends AbstractType
{

    /**
     * @var $userSession TokenStorageInterface
     */
    private $userSession;

    function __construct(MedicoRepository $medicoRepository,EmpresaRepository $empresaRepository, TokenStorageInterface $sessionToken) {

        $this->empresaRepo = $empresaRepository;
        $this->medicosRepo = $medicoRepository;
        $this->userSession = $sessionToken;

    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dtAso', DateType::class, [
                'format' => 'dd MM yyyy',
                'label' => 'Data do ASO',
            ])
            ->add('tipo',ChoiceType::class,[
                'choices'=> [
                    '0 - Exame médico admissional' => 'Exame médico admissional',
                    '1 - Exame médico periódico' => 'Exame médico periódico',
                    '2 - Exame médico de retorno ao trabalho' => 'Exame médico de retorno ao trabalho',
                    '3 - Exame médico de mudança de função' => 'Exame médico de mudança de função',
                    '4 - Exame médico de monitoração pontual' => 'Exame médico de monitoração pontual',
                    '9 - Exame médico demissional' => 'Exame médico demissional',
                ],
                'label' => 'Tipo do Exame',
            ])
            ->add('resultado',ChoiceType::class,[
                'choices'=> [
                    '1 - Apto' => 'Apto',
                    '2 - Inapto' => 'Inapto',
                ]
            ])
            ->add('empresa',null,[
                'query_builder' => function(EmpresaRepository $repo) {
                    return $repo->createQueryBuilder('e')
                        ->andWhere('e.escritorio in (:escritorio)')
                        ->setParameters(array('escritorio' => $this->userSession->getToken()->getUser()->getOffice()[0]));
                },
                'choice_label'=>function($empresa) {
                    return $empresa->getId().' - '. $empresa->getNome();
                },
                'label' => 'Empresa Assoaciada',
            ])
            ->add('funcionario',null,[
                'query_builder' => function(FuncionarioRepository $repo) {
                    return $repo->createQueryBuilder('f')
                        ->andWhere('f.company_id in (:empresa)')
                        ->setParameters(array('empresa' => $this->empresaRepo->findByEscritorio($this->userSession->getToken()->getUser()->getOffice())));
                },
                'choice_label'=>function($funcionario) {
                    return $funcionario->getId().' - '. $funcionario->getNome();
                },
                'label' => 'Funcionario Associado',
            ])
            ->add('medico_aso',null,[
                'query_builder'=> function(MedicoRepository $repo) {
                    return $repo->createQueryBuilder('m')
                        ->andWhere('m.escritorio in (:escritorio)')
                        ->setParameters(array('escritorio' => $this->userSession->getToken()->getUser()->getOffice()[0]));
                },
                'choice_label'=>function($medico) {
                    return $medico->getId().' - '. $medico->getNome();
                },
                'label' => 'Medico Avaliado',
            ])
            ->add('medico_pcmso',null,[
                'query_builder'=> function(MedicoRepository $repo) {
                    return $repo->createQueryBuilder('m')
                        ->andWhere('m.escritorio in (:escritorio)')
                        ->setParameters(array('escritorio' => $this->userSession->getToken()->getUser()->getOffice()[0]));
                },
                'choice_label'=>function($medico) {
                    return $medico->getId().' - '. $medico->getNome();
                },
                'label' => 'Medico Responsavel',
            ])
            ->add('exames', CollectionType::class, [
                'entry_type' => ExameType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Aso::class,
        ]);
    }
}
