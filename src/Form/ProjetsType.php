<?php

namespace App\Form;

use App\Entity\Projets;
use Doctrine\DBAL\Types\BooleanType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProjetsType extends AbstractType  
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
            ->add('titre',TextType::class,$this->getConfig("Titre  (*) :","Tapez  super titre",true))
            ->add('image',FileType::class, $this->getConfig("Url de  Photo (*) :", "Donne l'adresse de la photo",false))
            ->add('description',TextareaType::class, $this->getConfig("description (*) : ", "Tapez super  description",false))
            ->add('prix',MoneyType::class, $this->getConfig("description (*) : ", "Tapez super  description",false))
            ->add('etat',CheckboxType::class, [
                'label'    => 'Parmi les projets réalisé ?',
                'required' => false,
            ])

            ->add('setAt',DateType::class,$this->getConfig("Date de publication (*) :","Tapez  la date de publication ",true))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Projets::class,
        ]);
    }
}
