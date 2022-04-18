<?php

namespace App\Controller\Admin;

use App\Entity\Empresa;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class EmpresaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Empresa::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
            ->hideOnForm();
        yield Field::new('nome');
        yield Field::new('endereco');
        yield Field::new('phone', 'Telefone');
        yield TextareaField::new('descricao', 'Descrição')
            ->setMaxLength(50)
            ->onlyOnIndex();
        yield TextareaField::new('descricao', 'Descrição')
            ->hideOnIndex();
        yield Field::new('office', 'Escritorio');
    }

}
