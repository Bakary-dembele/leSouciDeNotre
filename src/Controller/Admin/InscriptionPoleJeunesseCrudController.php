<?php

namespace App\Controller\Admin;

use App\Entity\InscriptionPoleJeunesse;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class InscriptionPoleJeunesseCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return InscriptionPoleJeunesse::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            DateTimeField::new('dateInscription')->hideOnForm()->hideOnIndex(),
            AssociationField::new('poleJeunesse', 'PoleJeunesse')->hideOnForm(),
            AssociationField::new('user', 'User')->hideOnForm(),

        ];
    }

}
