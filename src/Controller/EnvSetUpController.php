<?php

namespace App\Controller;

use App\Entity\Task;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EnvSetUpController extends AbstractController
{
    #[Route('/test', name: 'env_set_up')]
    public function index(TaskRepository $taskRepository): Response
    {
        return $this->render('env_set_up/index.html.twig', [
            'tasks_backlog' => $taskRepository->findBy(['status' => 'backlog']),
            'tasks_todo' => $taskRepository->findBy(['status' => 'todo']),
        ]);
    }

    #[Route('/update-task/{id}', name: 'update-task', methods: ["POST"])]
    public function updateTaskStatus(Task $task, EntityManagerInterface $entityManager, Request $request): Response
    {
        $status = $request->request->get('status');

        $task->setStatus($status);

        $entityManager->flush();

        return new Response();
    }
}
