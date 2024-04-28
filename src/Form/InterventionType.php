<?php

namespace App\Form;

use App\Entity\Equipement;
use App\Entity\Intervention;
use App\Entity\Room;
use App\Entity\Tech;
use App\Entity\Theatre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InterventionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $types = array();
        foreach (Intervention::INTERVENTION['type'] as $type) {
            $types[$type] = $type;
        }

        $resolveds = array();
        foreach (Intervention::INTERVENTION['resolved'] as $resolved) {
            $resolveds[$resolved] = $resolved;
        }

        $canceleds = array();
        foreach (Intervention::INTERVENTION['canceled'] as $canceled) {
            $canceleds[$canceled] = $canceled;
        }
        
        $builder
            ->add('contact', ChoiceType::class, [
                'choices' => [
                    'oui' => true,
                    'non' => false,
                ],
                'placeholder' => '',
                
            ])
            ->add('type', ChoiceType::class, [
                'choices' => $types,
                'placeholder' => '',
                'label' => 'Type de contact',   
            ])
            ->add('resolved', ChoiceType::class, [
                'choices' => $resolveds,
                'placeholder'=> '',
                'label'=> 'Résolues',
            ])
            ->add('canceled', ChoiceType::class, [
                'choices' => $canceleds,
                'placeholder'=> '',
                'label'=> 'Annulations',
            ])
            ->add('description')
            ->add('dateTime', null, [
                'widget' => 'single_text',
            ])
            ->add('tech', EntityType::class, [
                'class' => Tech::class,
                'choice_label' => 'name',
                'placeholder'=> '',
                'label' => 'Intervenant',
            ])
            ->add('theatre', EntityType::class, [
                'class'=> Theatre::class,
                'choice_label' => 'name',
                'placeholder' => '',
                'label' => 'Cinéma',
            ])
            ->add('rooms', EntityType::class, [
                'class' => Room::class,
                'choice_label' => 'number',
                'multiple' => true,
                'label' => 'Salles',
            ])
            ->add('equipements', EntityType::class, [
                'class' => Equipement::class,
                'choice_label' => 'name',
                'multiple' => true,
                'label' => 'Equipements',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Intervention::class,
        ]);
    }
}
