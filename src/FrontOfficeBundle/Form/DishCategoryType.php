<?php

namespace FrontOfficeBundle\Form;

use AppBundle\Entity\DishCategory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

/**
 * Class DishCategoryType
 * @package AppBundle\Form
 */
class DishCategoryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('isAttending', ChoiceType::class, array(
            'choices'  => array(
                'Maybe' => null,
                'Yes' => true,
                'No' => false,
            ),
            'multiple' => true,
            'expanded' => true,
        ));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => DishCategory::class,
        ));
    }
}
