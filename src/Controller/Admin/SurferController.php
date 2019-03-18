<?php

namespace App\Controller\Admin;

use App\Entity\Surfer;
use App\Form\SurferType;
use App\Repository\SurferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/admin/surfer")
 */
class SurferController extends AbstractController
{
    /**
     * @Route("/", name="surfer_admin_index", methods={"GET"})
     */
    public function index(SurferRepository $surferRepository): Response
    {
        return $this->render('admin/surfer/index.html.twig', [
            'surfers' => $surferRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="surfer_admin_new", methods={"GET","POST"})
     */
    public function new(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $surfer = new Surfer();
        $form = $this->createForm(SurferType::class, $surfer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $surfer->setPassword(
                $passwordEncoder->encodePassword(
                    $surfer,
                    $form->get('password')->getData()
                )
            );

            // fill in the time , user group and other data
            $surfer->setInscriDate(new \DateTime());
            $surfer->setBanned(0);
            $surfer->setInscrActivated(1);
            $surfer->setRoles(array('ROLE_SURFER'));
            $surfer->setUnsucessfulTry(0);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($surfer);
            $entityManager->flush();

            return $this->redirectToRoute('surfer_admin_index');
        }

        return $this->render('admin/surfer/new.html.twig', [
            'surfer' => $surfer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="surfer_admin_show", methods={"GET"})
     */
    public function show(Surfer $surfer): Response
    {
        return $this->render('admin/surfer/show.html.twig', [
            'surfer' => $surfer,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="surfer_admin_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Surfer $surfer): Response
    {
        $form = $this->createForm(SurferType::class, $surfer);
        $form->remove('password');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $surfer->setInscrActivated(1);
            $surfer->setRoles(array('ROLE_SURFER'));

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('surfer_admin_index', [
                'id' => $surfer->getId(),
            ]);
        }

        return $this->render('admin/surfer/edit.html.twig', [
            'surfer' => $surfer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="surfer_admin_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Surfer $surfer): Response
    {
        if ($this->isCsrfTokenValid('delete'.$surfer->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($surfer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('surfer_admin_index');
    }
}
