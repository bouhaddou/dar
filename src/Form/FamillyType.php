<?php

namespace App\Form;

use App\Entity\Familly;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class FamillyType extends AbstractType
{
    private function getConfig($label, $place,$rool)
    {
        return  [
            'label' => $label, 
            'required'    => $rool,
            'attr' => [
                'placeholder' => $place
               
            ]
        ];
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class,$this->getConfig("Nom Complet (*) :","Tapez  le Nom de Famille",true))
            ->add('setAt',DateType::class,$this->getConfig("Date création (*) :","Tapez  la date de création Famille",true))
            ->add('adresse',TextareaType::class, $this->getConfig("Adresse  : (optionnel)", "Tapez Adresse de la Famille",false))
            ->add('phone',TextType::class,$this->getConfig("Numéro de Téléphone (*) :","Tapez  le Numéro  de Famille",true))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Familly::class,
        ]);
    }
}
