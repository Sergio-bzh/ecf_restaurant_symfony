<?php

namespace App\Controller\Admin;

use App\Entity\Allergie;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AllergieCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Allergie::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
