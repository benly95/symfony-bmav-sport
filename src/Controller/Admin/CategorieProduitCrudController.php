<?php

namespace App\Controller\Admin;

use App\Entity\CategorieProduit;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CategorieProduitCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CategorieProduit::class;
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
