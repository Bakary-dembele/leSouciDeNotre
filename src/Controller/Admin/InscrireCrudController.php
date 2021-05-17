<?php

namespace App\Controller\Admin;

use App\Entity\Inscrire;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class InscrireCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Inscrire::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('nom'),
            TextField::new('prenom', 'Prénom'),
            TextField::new('telephone', 'Téléphone'),
            EmailField::new('email'),
            AssociationField::new('evenement', 'Evenement')->hideOnForm()->hideOnIndex(),

        ];
    }

}
