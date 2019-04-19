<?php

namespace GarantiaBundle\Form;

use GarantiaBundle\Entity\TypeAssurance;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Bridge\Doctrine\Form\Type\EntityType ;
class ReductionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */


    /**
     * The Type requires the EntityManager as argument in the constructor. It is autowired
     * in Symfony 3.
     *
     * @param EntityManagerInterface $em
     */


    public function buildForm(FormBuilderInterface $builder, array $options)
    {






//...
        $builder->add('taux', ChoiceType::class, [
            'choices'  => [
                '20' => 20,
                '30' => 30,
                '40' => 40,
            ],
        ])->add('dateDebut')->add('dateFin')->add('id_assurance' , EntityType::class,
            array("class"=>"GarantiaBundle:TypeAssurance","choice_label"=>"nom","multiple"=>false))->add('Ajouter',SubmitType::class);
    }
    public function showAction() {

        $articles = $this->getDoctrine()
            ->getRepository('AppBundle:Article')
            ->findAll();

        return $this->render(
            'article/show.html.twig',
            array('articles' => $articles)
        );


    }







    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GarantiaBundle\Entity\Reduction'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'garantiabundle_reduction';
    }


}
