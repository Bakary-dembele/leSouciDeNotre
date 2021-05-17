<?php

namespace App\Controller\Admin;

use App\Entity\InscriptionCsm;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;

class InscriptionCsmCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return InscriptionCsm::class;
    }


    public function configureFields(string $pageName): iterable
    {
         return [
            IdField::new('id')->hideOnForm(),
            DateTimeField::new('dateInscription')->hideOnForm()->hideOnIndex(),
            AssociationField::new('csm', 'Csm')->hideOnForm(),
            AssociationField::new('user', 'User')->hideOnForm(),

        ];
    }

}
