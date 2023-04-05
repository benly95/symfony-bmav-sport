<?php

namespace App\Controller\Admin;

use App\Entity\Categorie;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CategorieCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Categorie::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Categorie')
            ->setEntityLabelInPlural('Categories')
            ->setPageTitle(Crud::PAGE_INDEX, "Liste des categories")
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
