<?php

namespace AssuranceBundle\Form;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TypeAssuranceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('champ1')
            ->add('champ2')
            ->add('champ3')
            ->add('champ4')
            ->add('critere1')
            ->add('devis1')
            ->add('critere2')
            ->add('devis2')
            ->add('critere3')
            ->add('devis3')
            ->add('critere4')
            ->add('devis4')
            ->add('prixInitial')
            ->add('image')
            ->add('description')
            ->add('ajouter',SubmitType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AssuranceBundle\Entity\TypeAssurance'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'assurancebundle_typeassurance';
    }


}
