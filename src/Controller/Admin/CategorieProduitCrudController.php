<?php

namespace App\Controller\Admin;

use App\Entity\CategorieProduit;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CategorieProduitCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CategorieProduit::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Categorie de produit')
            ->setEntityLabelInPlural('Categories de produit')
            ->setPageTitle(Crud::PAGE_INDEX, "Liste des categories de produit")
            ->setSearchFields(['nom', 'description']);
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('nom', "Nom");
        yield TextareaField::new('description', "Description")->hideOnIndex();
        yield ImageField::new('image', 'Image')
            ->setUploadDir("public/images/Accessoire/")
        ;
    }
}
