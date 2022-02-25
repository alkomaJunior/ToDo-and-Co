<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UpdateUserPasswordType;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authenticator\Passport\UserPassportInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

#[Route('/admin/user')]
class UserController extends AbstractController
{
    private TranslatorInterface $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    #[Route('/', name: 'user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'user_new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $userPasswordHasher
    ): Response {
        $user = new User();
        $form = $this->createForm(UserType::class, $user, [
            'validation_groups' => ['user_creation']
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword($userPasswordHasher->hashPassword($user, $user->getPlainPassword()));

            ($user->getAccountType() === $this->translator->trans('Simple user')) ?
                $user->setRoles(["ROLE_USER"]) :
                $user->setRoles(["ROLE_USER", "ROLE_ADMIN"]);

            $user->setSlug(strtolower($user->getFirstName() . $user->getLastName()));

            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', $this->translator
                ->trans('User successfully created'));

            return $this->redirectToRoute('user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{slug}/edit', name: 'user_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        User $user,
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $userPasswordHasher
    ): Response {
        $form = $this->createForm(UserType::class, $user, [
            'validation_groups' => ['user_editing']
        ]);
        $form->handleRequest($request);

        $formPwd = $this->createForm(UpdateUserPasswordType::class, $user, [
            'validation_groups' => ['user_password_update']
        ]);
        $formPwd->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setSlug(strtolower($user->getFirstName() . $user->getLastName()));

            ($user->getAccountType() === $this->translator->trans('Simple user')) ?
                $user->setRoles(["ROLE_USER"]) :
                $user->setRoles(["ROLE_USER", "ROLE_ADMIN"]);

            $entityManager->flush();

            $this->addFlash('success', $this->translator
                ->trans('User successfully edited'));

            return $this->redirectToRoute('user_index', [], Response::HTTP_SEE_OTHER);
        } elseif ($formPwd->isSubmitted() && $formPwd->isValid()) {
            $user->setPassword(
                $userPasswordHasher->hashPassword($user, $user->getPlainPassword())
            );

            $entityManager->flush();

            $this->addFlash('success', $this->translator
                ->trans('Password successfully edited'));

            return $this->redirectToRoute('user_edit', ['slug' => $user->getSlug()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
            'formPwd' => $formPwd,
        ]);
    }

    #[Route('/{slug}', name: 'user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $csrfId = sprintf("delete%s", $user->getSlug());

        if ($this->isCsrfTokenValid($csrfId, $request->request->get('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_index', [], Response::HTTP_SEE_OTHER);
    }
}
