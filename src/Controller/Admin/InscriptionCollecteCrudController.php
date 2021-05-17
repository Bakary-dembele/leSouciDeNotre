<?php

namespace App\Controller\Admin;

use App\Entity\InscriptionCollecte;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class InscriptionCollecteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return InscriptionCollecte::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            DateTimeField::new('dateInscription')->hideOnForm()->hideOnIndex(),
            AssociationField::new('collecte', 'Collecte')->hideOnForm(),
            AssociationField::new('user', 'User')->hideOnForm(),

        ];
    }

}
