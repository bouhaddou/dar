<?php

namespace App\Form;

use App\Entity\Familly;
use App\Entity\Orphelin;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class EditorphelinType extends AbstractType
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
        ->add('firstName',TextType::class,$this->getConfig("Prénom  (*) :","Tapez  le Prénom de Orphelin",true))
        ->add('lastName',TextType::class,$this->getConfig("Nom  (*) :","Tapez  le Nom de Orphelin",true))
        ->add('setAt',DateType::class,$this->getConfig("Date de Naissance (*) :","Tapez  la date de naissance ",true))
        ->add('adresse',TextareaType::class, $this->getConfig("Adresse (optionnel) : ", "Tapez Adresse de  l'Orphelin",true))
        ->add('genre',  ChoiceType::class, [
            'choices'  => [
                '' => null,
                'ذكر' => 'male',
                'انثى' => 'female',
            ],
            'label' => 'الجنس (*) :',
           
        ])
        ->add('familly',EntityType::class, [
            'class' => Familly::class,
            'choice_label' => 'nom',
            'label' => 'Parent :'
        ])
        ->add('status',  ChoiceType::class, 
            array(
                'label' => 'الحالة',
                'required' => true,
                'translation_domain' => 'messages',
                'choices' => array(
                'في انتظار الكفالة' => false,
                'مكفل' => true
                ),
                'expanded' => true,
                'multiple' => false,
                'data' => null,
                'attr' => array( 'class' => 'form_f' ),
            )
            
        )
    ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Orphelin::class,
        ]);
    }
}
