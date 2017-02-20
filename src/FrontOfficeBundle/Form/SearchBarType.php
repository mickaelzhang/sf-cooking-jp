<?php

namespace FrontOfficeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

/**
 * Class SearchBarType
 * @package AppBundle\Form
 */
class SearchBarType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('entityChoice', ChoiceType::class, array(
                'choices' => array(
                    'Utilisateur' => 'user',
                    'Recette' => 'recipe'
                ),
                'required' => true
            ))
            ->add('searchInput', SearchType::class);
    }
}
