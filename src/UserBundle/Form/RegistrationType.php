<?php


namespace UserBundle\Form;

use EWZ\Bundle\RecaptchaBundle\Form\Type\EWZRecaptchaType;
use EWZ\Bundle\RecaptchaBundle\Validator\Constraints\IsTrue as RecaptchaTrue;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('first_name', null, array('label' => 'Prénom','label_attr' => array('id' => 'first_name')))
            ->add('last_name', null, array('label' => 'Nom','label_attr' => array('id' => 'last_name')))
            ->add('address', null, array('label' => 'Adresse','label_attr' => array('id' => 'address')))
            ->add('gender', ChoiceType::class,array('choices'=>array('Homme'=>'Homme','Femme'=>'Femme'),'multiple'=>false,'expanded' => true,'label' => 'Sexe','label_attr' => array('id' => 'sexe')))
            ->add('recaptcha', EWZRecaptchaType::class, array(
            'attr'        => array(
                'options' => array(
                    'language' => 'fr',
                    'theme' => 'light',
                    'type'  => 'image',
                    'size'  => 'normal'
                )
            ),
            'mapped'      => false,
            'constraints' => array(
                new RecaptchaTrue()
            )
        ));
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

    // For Symfony 2.x
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}