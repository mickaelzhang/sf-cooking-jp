<?php
namespace FrontOfficeBundle\Form;

use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, array(
                'label' => ' ',
                'attr' => array(
                    'placeholder' => 'Mon pseudo*',
                    'class' => 'forms__inputs forms__inputsFull',
                ),
            ))
            ->add('email', EmailType::class, array(
                'label' => ' ',
                'attr' => array(
                    'placeholder' => 'Mon email*',
                    'class' => 'forms__inputs forms__inputsFull',
                ),
            ))
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array(
                    'label' => ' ',
                    'attr' => array(
                        'placeholder' => 'Mon mot de passe',
                        'class' => 'forms__inputs forms__inputsHalf',
                    )
                ),
                'second_options' => array(
                    'label' => ' ',
                    'attr' => array(
                        'placeholder' => 'Répéter le mot de passe',
                        'class' => 'forms__inputs forms__inputsHalf',
                    )
                ),
            ))
            ->add('firstname', TextType::class, array(
                'label' => ' ',
                'attr' => array(
                    'placeholder' => 'Mon prénom*',
                    'class' => 'forms__inputs forms__inputsHalf',
                ),
            ))
            ->add('lastname', TextType::class, array(
                'label' => ' ',
                'attr' => array(
                    'placeholder' => 'Mon nom*',
                    'class' => 'forms__inputs forms__inputsHalf',
                ),
            ))
            ->add('image', FileType::class, array(
                'label' => ' ',
                'attr' => array(
                    'class' => 'forms__inputs forms__inputsFull forms__inputsImage',
                ),
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
        ));
    }
}
