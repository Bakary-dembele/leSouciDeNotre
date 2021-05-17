<?php

namespace App\Controller\Admin;

use App\Entity\InscriptionEvenementFoot;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class InscriptionEvenementFootCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return InscriptionEvenementFoot::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('nom'),
            TextField::new('prenom', 'Prénom'),
            TextField::new('telephone', 'Téléphone'),
            EmailField::new('email'),
            /*AssociationField::new('evenementFoot', 'Evenement'),*/
        ];
    }

}
