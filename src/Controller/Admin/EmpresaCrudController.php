<?php

namespace App\Controller\Admin;

use App\Entity\Empresa;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class EmpresaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Empresa::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
