<?php

namespace App\Controller\Admin;

use App\Entity\Marque;
use App\Form\Admin\VariantProduitType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MarqueCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Marque::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Marque')
            ->setEntityLabelInPlural('Marques')
            ->setPageTitle(Crud::PAGE_INDEX, "Liste des marques")
            ->setSearchFields(['nom', 'description']);
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('nom', "Nom");
        yield TextareaField::new('description', "Description")->hideOnIndex();
        yield ImageField::new('imageLogo', 'Image')
            ->setUploadDir("public/images/Logo/")
        ;
    }
}
