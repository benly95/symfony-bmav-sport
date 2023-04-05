<?php

namespace App\Controller\Admin;

use App\Entity\Produit;
use App\Form\Admin\VariantProduitType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ProduitCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Produit::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Produit')
            ->setEntityLabelInPlural('Produits')
            ->setPageTitle(Crud::PAGE_INDEX, "Liste des produits")
            ->setSearchFields(['nom', 'description']);
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('nom', "Nom");
        yield TextareaField::new('description', "Description")->hideOnIndex();
        yield ImageField::new('image', 'Image')
                ->setUploadDir("public/images/Produit/")
        ;
        yield AssociationField::new('Marque');
        yield AssociationField::new('Categorie');
        yield AssociationField::new('categorieProduit');
        yield CollectionField::new('variantProduits')
            ->onlyOnForms()
            ->setEntryIsComplex()
            ->renderExpanded()
            ->setEntryType(VariantProduitType::class)
        ;
    }

}
