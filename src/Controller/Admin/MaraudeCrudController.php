<?php

namespace App\Controller\Admin;

use App\Entity\Maraude;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\PercentField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimezoneField;

class MaraudeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Maraude::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('nom'),
            DateTimeField::new('dateDebut', 'date de début'),
            DateTimeField::new('dateCloture', 'date de clôture'),
            IntegerField::new('nbInscriptionsMax'),
            IntegerField::new('duree', 'durée'),
            TextareaField::new('descriptionInfos'),
            AssociationField::new('groupe', 'Groupe'),
            TextareaField::new('ville', 'Ville'),

        ];
    }

}
