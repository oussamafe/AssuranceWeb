<?php

namespace GarantiaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType ;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ConstatType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prenoma',null, array('label' => 'Prénom Client A:'))
            ->add('adressea',null, array('label' => 'Adresse Client A:'))
            ->add('permisa',null, array('label' => 'Permis Client A:'))
            ->add('delivrea',null, array('label' => 'Delivré le:'))
            ->add('marquea',null, array('label' => 'Marque'))
            ->add('immatriculationa',null, array('label' => 'Immatriculation'))
            ->add('choca', null, array('label' => 'Choc voiture Client A:'))
            ->add('chocb', null, array('label' => 'Choc voiture Client B:'))
            ->add('circonstance1', null, array('label' => 'Circonstances: En Stationnement'))
            ->add('circonstance2', null, array('label' => 'Circonstances: Arret de Circulation'))
            ->add('circonstance3', null, array('label' => 'Circonstances: Changeait de File'))
            ->add('circonstance4',null, array('label' => 'Circonstances: Doublait'))
            ->add('circonstance5', null, array('label' => 'Circonstances: Virait'))
            ->add('circonstance6', null, array('label' => 'Circonstances:Reculait'))
            ->add('circonstance7', null, array('label' => 'Circonstances: Pas de Respect de Priorité'))
            ->add('circonstance8', null, array('label' => 'Circonstances: Sens Inverse'))
            ->add('circonstance9', null, array('label' => 'Circonstances: S"engager dans un parking'))
            ->add('circonstanceautre', null, array('label' => 'Autres Circonstances'))
            ->add('nomb', null, array('label' => 'Nom Client B '))
            ->add('prenomb', null, array('label' => 'Prenom Client B'))
            ->add('adresseb', null, array('label' => 'Adresse Client B'))
            ->add('permisb', null, array('label' => 'Numéro permis Client B'))
            ->add('delivreb', null, array('label' => 'Delivé le'))
            ->add('marqueb', null, array('label' => 'Marque'))
            ->add('immatriculationb', null, array('label' => 'Immatriculation N*'));



    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GarantiaBundle\Entity\Constat'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'garantiabundle_constat';
    }


}
