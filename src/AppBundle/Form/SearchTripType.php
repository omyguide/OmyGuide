<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class SearchTripType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('destination',  EntityType::class, array('class' => 'AppBundle:Country', 'choice_label' => 'country', 'multiple'     => false ))
          ->add('date_begin',  DateType::class, array('widget' => 'single_text', 'format' => 'MM/dd/yyyy', 'attr' => ['class' => 'js-datepicker s-input-dep'], 'html5' => false, 'required' => false))
          ->add('date_end',    DateType::class, array('widget' => 'single_text', 'format' => 'MM/dd/yyyy', 'attr' => ['class' => 'js-datepicker s-input-dep'], 'html5' => false, 'required' => false))
          ->add('submit',     SubmitType::class)
          ->getForm();
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\SearchTrip'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_searchtrip';
    }


}
