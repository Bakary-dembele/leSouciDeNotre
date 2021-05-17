<?php

namespace App\Controller\Admin;

use App\Entity\PoleVisite;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PoleVisiteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PoleVisite::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('details', 'Détails'),
            DateTimeField::new('dateHeure', 'Date de heure'),
            DateTimeField::new('dateCloture', 'Date de clôture'),
            AssociationField::new('referent', 'Référent')->hideOnForm(),
            TelephoneField::new('adresse', 'Adresse'),
            NumberField::new('nombreDePlace', 'Nombre de place'),
        ];
    }

}
