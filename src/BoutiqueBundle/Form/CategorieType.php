<?php

namespace BoutiqueBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategorieType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle', \Symfony\Component\Form\Extension\Core\Type\TextType::class,array(
                'attr'=> array(
                    'placeholder' => 'libelle',

                )
            ))


            ->add('description', \Symfony\Component\Form\Extension\Core\Type\TextareaType::class,array(
                'attr'=> array(
                    'placeholder' => 'Descrption',

                )
            ))            ->add('Save', SubmitType::class , array(
                'attr' => array(

                    'class'=>'btn btn-success'
                )));;
        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\Categorie'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'sante_userbundle_categorie';
    }


}
