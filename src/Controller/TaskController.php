<?php

namespace App\Controller;

use App\Entity\Task;
use App\Entity\User;
use App\Form\TaskType;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

#[Route('/task')]
class TaskController extends AbstractController
{
    private TranslatorInterface $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    #[Route('/', name: 'task_index', methods: ['GET'])]
    public function index(TaskRepository $taskRepository): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        return $this->render('task/index.html.twig', [
            'tasks' => $taskRepository->findTaskByUser($user->getId()),
        ]);
    }

    #[Route('/other-tasks', name: 'anonym_user_tasks', methods: ['GET'])]
    #[IsGranted('ROLE_ADMIN')]
    public function anonymUserTasks(TaskRepository $taskRepository): Response
    {
        return $this->render('task/anonymUserTask.html.twig', [
            'tasks' => $taskRepository->findTaskByUser(1),
        ]);
    }

    #[Route('/dashboard', name: 'app_dashboard', methods: ['GET'])]
    public function dashboard(TaskRepository $taskRepository): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        return $this->render('dashboard/dashboard.html.twig', [
            'tasks' => $taskRepository->findTaskByUser($user->getId()),
        ]);
    }

    #[Route('/update-status/{id}', name: 'task_update_status', methods: ["POST"])]
    public function updateTaskStatus(Task $task, EntityManagerInterface $entityManager, Request $request): Response
    {
        $status = $request->request->get('status');

        $task->setStatus($status);
        $task->setSlug(strtolower(preg_replace('/\s+/', '', $task->getStatus() . $task->getId())));

        $entityManager->flush();

        return new Response();
    }

    /**
     * @throws \Exception
     */
    #[Route('/new', name: 'task_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);
        /** @var User $user */
        $user = $this->getUser();

        if ($form->isSubmitted() && $form->isValid()) {
            $task->setStatus("todo");
            $task->setSlug(strtolower(preg_replace('/\s+/', '', $task->getTitle())));
            $task->setUser($user);
            $entityManager->persist($task);
            $entityManager->flush();

            $this->addFlash('success', $this->translator
                ->trans('Task successfully created'));

            return $this->redirectToRoute('task_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('task/new.html.twig', [
            'task' => $task,
            'form' => $form,
        ]);
    }

    #[Route('/{slug}/edit', name: 'task_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Task $task, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', $this->translator
                ->trans('Task successfully edited'));

            return $this->redirectToRoute('task_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('task/edit.html.twig', [
            'task' => $task,
            'form' => $form,
        ]);
    }

    #[Route('/{slug}', name: 'task_delete', methods: ['POST'])]
    public function delete(Request $request, Task $task, EntityManagerInterface $entityManager): Response
    {
        $csrfId = sprintf("delete%s", $task->getSlug());

        if ($this->isCsrfTokenValid($csrfId, $request->request->get('_token'))) {
            $entityManager->remove($task);
            $entityManager->flush();
        }

        return $this->redirectToRoute('task_index', [], Response::HTTP_SEE_OTHER);
    }
}
