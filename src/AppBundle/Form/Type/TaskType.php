<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('task')
            ->add('dueDate', null, array('widget' => 'single_text'))
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
}

