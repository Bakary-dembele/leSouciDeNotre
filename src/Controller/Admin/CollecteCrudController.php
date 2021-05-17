<?php

namespace App\Controller\Admin;

use App\Entity\Collecte;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CollecteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Collecte::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('details', 'Détails'),
            DateTimeField::new('dateHeure', 'Date et heure'),
            DateTimeField::new('dateCloture', 'Date de clôture'),
            AssociationField::new('referent', 'Référent')->hideOnForm(),
            TelephoneField::new('adresse'),
            NumberField::new('nombreDePlace', 'Nombre de place'),
        ];
    }

}
