<?php

namespace App\Form;

use App\Entity\Funcionario;
use App\Repository\EmpresaRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class FuncionarioType extends AbstractType
{
    /**
     * @var $userSession TokenStorageInterface
     */
    private $userSession;

    function __construct(EmpresaRepository $empresaRepository, TokenStorageInterface $sessionToken) {
        $this->empresaRepo = $empresaRepository;
        $this->userSession = $sessionToken;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nome')
            ->add('email')
            ->add('phone', null, [
                'label' => 'Telefone',
            ])
            ->add('celular')
            ->add('salario', null, [
                'label' => 'Salário',
            ])
            ->add('cpf', null, [
                'label' => 'CPF',
            ])
            ->add('caepf', null, [
                'label' => 'CAEPF',
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
            ->add('matricula', null, [
                'label' => 'Matrícula',
            ])
            ->add('categoria')
            ->add('company_id',null,[
                'query_builder'=>function(EmpresaRepository $repo) {
                    return $repo->createQueryBuilder('e')
                    ->andWhere('e.escritorio in (:escritorio)')
                    ->setParameters(array('escritorio' => $this->userSession->getToken()->getUser()->getOffice()[0]));

                },
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
            'data_class' => Funcionario::class,
        ]);
    }
}
