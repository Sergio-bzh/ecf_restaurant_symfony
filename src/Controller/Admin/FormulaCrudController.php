<?php

namespace App\Controller\Admin;

use App\Entity\Formula;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class FormulaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Formula::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield from parent::configureFields(($pageName));
        yield AssociationField::new('menu');
        yield AssociationField::new('dish');
    }
}
