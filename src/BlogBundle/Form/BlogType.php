<?php

namespace BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BlogType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title' ,\Symfony\Component\Form\Extension\Core\Type\TextType::class,array('attr'=>array('placeholder'=>'titre')))->add('author',\Symfony\Component\Form\Extension\Core\Type\TextType::class,array('attr'=>array('placeholder'=>'auteur')))->add('file',\Symfony\Component\Form\Extension\Core\Type\FileType::class,array())->add('contenu' ,\Symfony\Component\Form\Extension\Core\Type\TextareaType::class,array('attr'=>array('placeholder'=>'Votre Article...')))
            ->add('Confirm',SubmitType::class,array('attr'=>array('class'=>'btn btn-success')));

        ;


    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\Blog'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'userbundle_blog';
    }


}
