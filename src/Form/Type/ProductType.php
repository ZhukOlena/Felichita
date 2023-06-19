<?php

declare(strict_types=1);

namespace App\Form\Type;

use App\Entity\Product;
use App\Entity\ProductCategory;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefault("data_class", Product::class);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       $builder
           ->add('category', EntityType::class, [
               'label' => 'Category',
               'class' => ProductCategory::class,
               'choice_label' => 'title',
           ])
           ->add('title', TextType::class, [
               'label' => 'Title',
           ])
           ->add('subTitle', TextType::class, [
               'label' => 'Sub title',
           ])
           ->add('ingredients', TextType::class, [
               'label' => 'Ingredients',
           ])
           ->add('price', NumberType::class, [
               'label' => 'Price',
               'scale' => 2,
           ])
           ->add('weight', IntegerType::class, [
               'label' => 'Weight',
               'help' => 'Please enter weight of product in gram (not kilo-gram).',
           ])
           ->add('calories', IntegerType::class, [
               'label' => 'Calories',
               'required' => false,
           ])
           ->add('priority', IntegerType::class, [
               'label' => 'Priority',
           ])
           ->add('Submit', SubmitType::class, [
               'label' => 'Submit',
           ]);
    }
}