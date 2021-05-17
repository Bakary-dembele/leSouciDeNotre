<?php

namespace App\Controller\Admin;

use App\Entity\Collecte;
use App\Entity\Csm;
use App\Entity\Evenement;
use App\Entity\EvenementFoot;
use App\Entity\Groupe;
use App\Entity\InscriptionCollecte;
use App\Entity\InscriptionCsm;
use App\Entity\InscriptionEvenementFoot;
use App\Entity\InscriptionPoleJeunesse;
use App\Entity\InscriptionPoleVisite;
use App\Entity\Inscrire;
use App\Entity\Maraude;
use App\Entity\NewsLetter;
use App\Entity\PoleJeunesse;
use App\Entity\PoleVisite;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('LeSouciDeNotre');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-newspaper', User::class);
        yield MenuItem::linkToCrud('Evenement brunch', 'fas fa-newspaper', Evenement::class);
        yield MenuItem::linkToCrud('participants brunch', 'fas fa-newspaper', Inscrire::class);
        yield MenuItem::linkToCrud('Evenement foot', 'fas fa-newspaper', EvenementFoot::class);
        yield MenuItem::linkToCrud('participants foot', 'fas fa-newspaper', InscriptionEvenementFoot::class);
        yield MenuItem::linkToCrud('Maraude', 'fas fa-newspaper', Maraude::class);
        yield MenuItem::linkToCrud('Collecte', 'fas fa-newspaper', Collecte::class);
        yield MenuItem::linkToCrud('Participants collecte', 'fas fa-newspaper', InscriptionCollecte::class);
        yield MenuItem::linkToCrud('Pôle jeunesse', 'fas fa-newspaper', PoleJeunesse::class);
        yield MenuItem::linkToCrud('participants jeunesse', 'fas fa-newspaper', InscriptionPoleJeunesse::class);
        yield MenuItem::linkToCrud('Pôle visite', 'fas fa-newspaper', PoleVisite::class);
        yield MenuItem::linkToCrud('participants visite', 'fas fa-newspaper', InscriptionPoleVisite::class);
        yield MenuItem::linkToCrud('Csm', 'fas fa-newspaper', Csm::class);
        yield MenuItem::linkToCrud('participants Csm', 'fas fa-newspaper', InscriptionCsm::class);
        yield MenuItem::linkToCrud('Groupe', 'fas fa-newspaper', Groupe::class);
        yield MenuItem::linkToCrud('Newsletter', 'fas fa-newspaper', NewsLetter::class);

    }


}











