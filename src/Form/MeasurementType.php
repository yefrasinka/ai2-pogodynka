<?php

namespace App\Form;

use App\Entity\Location;
use App\Entity\Measurement;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MeasurementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', DateType::class, [
                'label' => 'Data pomiaru',
                'widget' => 'single_text', 
                'input' => 'datetime',
            ])
            ->add('celsius', NumberType::class, [
                'label' => 'Temperatura (°C)',
                'attr' => ['placeholder' => 'np. 22.5'],
            ])
            ->add('location', EntityType::class, [
                'class' => Location::class,
                'choice_label' => 'city', 
                'label' => 'Lokalizacja',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Measurement::class,
        ]);
    }
}
