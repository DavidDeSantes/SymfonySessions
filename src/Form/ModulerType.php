<?php

namespace App\Form;

use App\Entity\Moduler;
use App\Entity\Cours;
use App\Entity\Session;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModulerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nbJoursCours', NumberType::class)
            ->add('cours', EntityType::class, [
                'class' => Cours::class,
                'choice_label' => 'nomCours'
            ])
            ->add('session', EntityType::class, [
                'class' => Session::class,
                'choice_label' => 'nomSession'
            ])
            ->add('valider', SubmitType::class, [
                'attr' => [
                    'class' => 'button'
                ]
                ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Moduler::class,
        ]);
    }
}
