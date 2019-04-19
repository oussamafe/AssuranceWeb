<?php

namespace GarantiaBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class JugementType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('observation')
            ->add('verdict')
            ->add('idIncident', EntityType::class,
                array(
                    "class" => "GarantiaBundle:Incident",
                    'query_builder' => function (EntityRepository $er) {

                        return $er->createQueryBuilder('u')
                            ->where('u.etat = 2');
                    },
                    'choice_label' => 'id',
                    'multiple' => false,
                    ))
            ->add('Ajouter', SubmitType::class);


    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GarantiaBundle\Entity\Jugement'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'garantiabundle_jugement';
    }


}
