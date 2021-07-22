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
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;

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
            ->add('image1',FileType::class, [
                'label' => 'Image',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/png', 
                            'image/jpeg', 
                            'image/webp',
                        ],
                        'mimeTypesMessage' => 'Merci de charger une image valide',
                    ])
                ]

            ])
            ->add('image2',FileType::class, [

                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/png', 
                            'image/jpeg', 
                            'image/webp',
                        ],
                        'mimeTypesMessage' => 'Merci de charger une image valide',
                    ])
                ]

            ])
            ->add('image3',FileType::class, [
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/png', 
                            'image/jpeg', 
                            'image/webp',
                        ],
                        'mimeTypesMessage' => 'Merci de charger une image valide',
                    ])
                ]

            ])
            ->add('brochure',FileType::class, [
                'mapped' => false,
                'required' => false,
            ])
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
