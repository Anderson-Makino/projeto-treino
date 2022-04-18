<?php

namespace App\Controller\Admin;

use App\Entity\Usuario;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UsuarioCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Usuario::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
            yield IdField::new('id')
                ->hideOnForm();
            yield Field::new('username');
            yield Field::new('email');
            yield Field::new('password')
                ->hideOnIndex();
            yield ChoiceField::new('roles')->setChoices([
                'ROLE_ADMIN' => 'ROLE_ADMIN',
                'ROLE_USER' => 'ROLE_USER'
            ])->allowMultipleChoices()
            ->renderExpanded()
            ->renderAsBadges();
            yield AssociationField::new('office');
    }
    
}
