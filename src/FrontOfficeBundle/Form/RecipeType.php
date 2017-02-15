<?php

namespace FrontOfficeBundle\Form;

use AppBundle\Entity\Recipe;
use FrontOfficeBundle\Form\DishCategoryType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class RecipeType
 * @package AppBundle\Form
 */
class RecipeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('description', TextareaType::class)
            ->add('difficulty', IntegerType::class)
            ->add('servingSize', IntegerType::class)
            ->add('image', FileType::class, array(
                'label' => 'Image de la recette'
            ))
            ->add('preparationTime', TimeType::class, array(
                'input' => 'datetime',
                'widget' => 'single_text',
            ))
            ->add('cookingTime', TimeType::class, array(
                'input' => 'datetime',
                'widget' => 'single_text',
            ))
            ->add('instructions', TextareaType::class)
            ->add('dishCategory', EntityType::class, array(
                'class' => 'AppBundle:DishCategory',
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true
            ));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Recipe::class,
        ));
    }
}
