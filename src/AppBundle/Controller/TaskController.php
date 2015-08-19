<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use AppBundle\Form\Type\TaskType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    public function newAction(Request $request)
    {
        // Requires user to be logged in.
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException('You need to be logged in');
        }

        $user = $this->getUser();
        d($user);

        // Create a task and give it some dummy data.
        $task = new Task();
        $task->setDueDate(new \DateTime('tomorrow'));

        $form = $this->createFormBuilder($task)
            ->add('task', 'text')
            ->add('dueDate', 'date', array(
                'widget' => 'single_text',
                'label' => 'Enter the due date:',
            ))
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
        return $this->render(':default:index.html.twig', array(
            'body' => 'Thank you for creating your task.'
        ));
    }

    public function newBasedOffTypeAction(Request $request)
    {
        // Require admin access to access this page.
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Admin access required.');

        $task = new Task();
        $task->setDueDate(new \DateTime('today'));

        $form = $this->createForm(new TaskType(), $task);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->addFlash('notice', 'Created task with the title: ' . $form->get('task')->getData());
            // Persist object in the database.
            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();

            return $this->redirectToRoute('task_success');
        }

        return $this->render('@App/Task/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}