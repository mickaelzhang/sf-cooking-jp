<?php
namespace AdminBundle\Form;

use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class UserAdminType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, array(
                'label' => ' ',
                'attr' => array(
                    'placeholder' => 'Email*',
                    'class' => 'forms__inputs forms__inputsFull',
                ),
            ))
            ->add('firstname', TextType::class, array(
                'label' => ' ',
                'attr' => array(
                    'placeholder' => 'Prénom*',
                    'class' => 'forms__inputs forms__inputsFull',
                ),
            ))
            ->add('lastname', TextType::class,  array(
                'label' => ' ',
                'attr' => array(
                    'placeholder' => 'Nom*',
                    'class' => 'forms__inputs forms__inputsFull',
                ),
            ))
            ->add('username', TextType::class,  array(
                'label' => ' ',
                'attr' => array(
                    'placeholder' => 'Pseudo*',
                    'class' => 'forms__inputs forms__inputsFull',
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
