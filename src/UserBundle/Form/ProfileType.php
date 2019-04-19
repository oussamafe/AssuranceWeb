<?php
/**
 * Created by PhpStorm.
 * User: Oussama Fezzani
 * Date: 16/04/2019
 * Time: 14:05
 */

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class ProfileType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('first_name', null, array('label' => 'Prénom','label_attr' => array('id' => 'first_name')))
            ->add('last_name', null, array('label' => 'Nom','label_attr' => array('id' => 'last_name')))
            ->add('address', null, array('label' => 'Adresse','label_attr' => array('id' => 'address')))
            ->add('gender', ChoiceType::class,array('choices'=>array('Homme'=>'Homme','Femme'=>'Femme'),'multiple'=>false,'expanded' => true,'label' => 'Sexe','label_attr' => array('id' => 'sexe')));
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\ProfileFormType';

    }

    public function getBlockPrefix()
    {
        return 'app_user_profile';
    }
}