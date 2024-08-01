<?php

namespace App\Form;

use App\Entity\Departements;
use App\Entity\Regions;
use App\Entity\Users;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use function PHPSTORM_META\map;

class UserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
    
        $builder
            ->add('pseudo',TextType::class,[
                'attr' => [
                    'placeholder' => 'Pseudo',
                    'class' => 'form-control',
                    'maxlength' => '25',
                ],
                'label' => 'Pseudo',
                'required' => true,
      

            
            ])
            ->add('email', TextType::class, [
                'attr' => [
                    'placeholder' => 'Email',
                    
                    'maxlength' => '25',
                ],
                'label' => 'Email',
                'required' => true,
            ])
            ->add('sexe' , ChoiceType::class, [
                'choices' => [
                    'Homme' => 'Homme',
                    'Femme' => 'Femme',
                ],
                'label' => 'Sexe',
                'required' => true,
            ])
            ->add('age',NumberType::class, [
                'attr' => [
                    'placeholder' => 'Age',
                    'class' => 'form-control',
                    'maxlength' => '3',
                ],
                'label' => 'Age',
                'required' => true,
            ])
            ->add('regions', EntityType::class,[

                'class' => Regions::class,
                'choice_label' => 'name',
                'label' => 'Region',
                'required' => false,
            ])
            ->add('departements', EntityType::class,[

                'class' => Departements::class,
                'choice_label' => 'name',
                'label' => 'Region',
                'required' => false,
                // 'mapped' => false
            ]);
            
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
