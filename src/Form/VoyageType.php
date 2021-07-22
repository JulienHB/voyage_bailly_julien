<?php

namespace App\Form;

use App\Entity\Voyage;
use App\Entity\Categorie;
use App\Entity\Tag;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VoyageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('accroche')
            ->add('description')
            ->add('prix',MoneyType::class)
            ->add('duree')
            ->add('image1')
            ->add('image2')
            ->add('image3')
            ->add('brochure')
            ->add('idCat',EntityType::class,[
                'class'=>Categorie::class,
                'choice_label'=>'nom'
            ])
            ->add('tags',EntityType::class,[
                'multiple'=>true,
                'class'=>Tag::class,
                'choice_label'=>'nom'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Voyage::class,
        ]);
    }
}
