<?php

namespace App\Form;

use App\Entity\Kafala;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class KafalaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('setAtdebut')
            ->add('type')
            ->add('prix')
            ->add('periode')
            ->add('Orphelin')
            ->add('garant')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Kafala::class,
        ]);
    }
}
