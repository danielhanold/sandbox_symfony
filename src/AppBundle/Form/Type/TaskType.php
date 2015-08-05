<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('task')
            ->add('dueDate', null, array('widget' => 'single_text'))
            ->add('termsAgreed', 'checkbox', array(
                // Field is not mapped in the Task object. To prevent this
                // from causing an error, mark it's mapped character as "false".
                'mapped' => false,
                'label' => 'Agree to terms'
            ))
            ->add('save', 'submit');
    }

    /**
     * Define identifier for this form type.
     * Must be unique throughout the application.
     *
     * @return string
     */
    public function getName()
    {
        return 'app_task';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Task'
        ));
    }
}

