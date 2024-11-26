<?php

namespace App\Form;

use App\Entity\Image;
use App\Entity\Project;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('isVisible',CheckboxType::class,[
                'required'=>false,
                'label'=>'visible ?',
                "data"=>false,
            ])
            ->add('description')
            ->add('githubLink')
            ->add('link')
            ->add('step1')
            ->add('step2')
            ->add('step3');


    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
            'mapped' => false, // Désactive le mapping automatique pour certaines propriétés

        ]);
    }
}
