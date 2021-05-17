<?php

namespace App\Controller\Admin;

use App\Entity\EvenementFoot;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;

class EvenementFootCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return EvenementFoot::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('titre'),
            TextareaField::new('descriptif', 'Déscriptif'),
            TextField::new('prix', 'Prix')->hideOnIndex()->hideOnForm(),
            DateField::new('date', 'Date'),
            TextField::new('adresse', 'Adresse'),
            TimeField::new('heureDebut', 'Heure de début'),
            TimeField::new('heureFin', 'Heure de fin'),
            TextareaField::new('details', 'Détails'),
        ];
    }

}
