<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    public function newAction(Request $request)
    {
        // Create a task and give it some dummy data.
        $task = new Task();
        $task->setTask('Write a blog post');
        $task->setDueDate(new \DateTime('tomorrow'));

        $form = $this->createFormBuilder($task)
            ->add('task', 'text')
            ->add('dueDate', 'date')
            ->add('save', 'submit', array('label' => 'Create Task'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            // Perform some action, such as saving the task to the database.
            return $this->redirectToRoute('task_success');
        }

        return $this->render('@App/Task/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function successAction() {
        return new Response('Your task was successfully created.');
    }
}