<?php

namespace App\Controller\Admin;

use App\Entity\Allergie;
use App\Entity\Category;
use App\Entity\Dish;
use App\Entity\Formula;
use App\Entity\Image;
use App\Entity\Menu;
use App\Entity\Reservation;
use App\Entity\Restaurant;
use App\Entity\Schedule;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Ecf Restaurant Symfony');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Restaurant', 'fa fa-list', Restaurant::class);
        yield MenuItem::linkToCrud('Schedule', 'fa fa-list', Schedule::class);
        yield MenuItem::linkToCrud('User', 'fa fa-list', User::class);
        yield MenuItem::linkToCrud('Category', 'fa fa-list', Category::class);
        yield MenuItem::linkToCrud('Menu', 'fa fa-list', Menu::class);
        yield MenuItem::linkToCrud('Allergie', 'fa fa-list', Allergie::class);
        yield MenuItem::linkToCrud('Dish', 'fa fa-list', Dish::class);
        yield MenuItem::linkToCrud('Formula', 'fa fa-list', Formula::class);
        yield MenuItem::linkToCrud('Reservation', 'fa fa-list', Reservation::class);
        yield MenuItem::linkToCrud('Image', 'fa fa-list', Image::class);
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
