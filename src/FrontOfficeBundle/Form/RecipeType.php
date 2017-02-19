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
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
            ->add('name', TextType::class, array(
                'label' => ' ',
                'attr' => array(
                    'placeholder' => 'Nom*',
                    'class' => 'forms__inputs forms__inputsFull',
                ),
            ))
            ->add('description', TextareaType::class, array(
                'label' => ' ',
                'attr' => array(
                    'placeholder' => 'Description*',
                    'class' => 'forms__inputs forms__inputsFull',
                ),
            ))
            ->add('difficulty', ChoiceType::class, array(
                'label' => ' ',
                'choices'  => array(
                    'Facile' => 1,
                    'Moyen' => 2,
                    'Difficile' => 3,
                ),
                'expanded' => true,
                'attr' => array(
                    'class' => 'forms__inputs forms__inputsSelect',
                ),
            ))
            ->add('servingSize', IntegerType::class, array(
                'label' => ' ',
                'attr' => array(
                    'placeholder' => 'Nombre de personnes*',
                    'class' => 'forms__inputs forms__inputsFull',
                    'min' => '1',
                ),
            ))
            ->add('image', FileType::class, array(
                'label' => ' ',
                'attr' => array(
                    'placeholder' => 'Nom*',
                    'class' => 'forms__inputs forms__inputsFull',
                ),
            ))
            ->add('preparationTime', TimeType::class, array(
                'label' => ' ',
                'input' => 'datetime',
                'widget' => 'single_text',
                'attr' => array(
                    'placeholder' => 'Temps de préparation*',
                    'class' => 'forms__inputs forms__inputsFull',
                ),
            ))
            ->add('cookingTime', TimeType::class, array(
                'label' => ' ',
                'input' => 'datetime',
                'widget' => 'single_text',
                'attr' => array(
                    'placeholder' => 'Temps de cuisson*',
                    'class' => 'forms__inputs forms__inputsFull',
                ),
            ))
            ->add('instructions', TextareaType::class, array(
                'label' => ' ',
                'attr' => array(
                    'placeholder' => 'Détail de la recette*',
                    'class' => 'forms__inputs forms__inputsFull',
                    'rows' => '20',
                ),
            ))
            ->add('dishCategory', EntityType::class, array(
                'label' => ' ',
                'class' => 'AppBundle:DishCategory',
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'attr' => array(
                    'class' => 'forms__inputs forms__inputsCheckboxes',
                ),
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
