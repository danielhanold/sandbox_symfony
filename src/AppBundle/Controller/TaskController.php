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
        $task->setDueDate(new \DateTime('tomorrow'));

        $form = $this->createFormBuilder($task)
            ->add('task', 'text')
            ->add('dueDate', 'date')
            ->add('save', 'submit', array('label' => 'Create Task'))
            ->add('saveAndAdd', 'submit', array('label' => 'Save and Add'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            // Perform some action, such as saving the task to the database.
            // Switch depending on which button was clicked.
            $nextAction = $form->get('saveAndAdd')->isClicked() ? 'task_new' : 'task_success';

            if ($nextAction == 'task_new') {
                $this->addFlash('notice', 'Your task was successfully created. Add a new one');
            }

            return $this->redirectToRoute($nextAction);
        }

        return $this->render('@App/Task/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function successAction() {
        return new Response('Your task was successfully created.');
    }
}