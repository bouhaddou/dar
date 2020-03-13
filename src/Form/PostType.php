<?php

namespace App\Form;

use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PostType extends AbstractType
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
            ->add('description',TextareaType::class, $this->getConfig("description (*) : ", "Tapez super  description",false))
            ->add('image',FileType::class, $this->getConfig("Url de  Photo (*) :", "Donne l'adresse de la photo",false))
            ->add('setAt',DateType::class,$this->getConfig("Date de publication (*) :","Tapez  la date de publication ",true))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
