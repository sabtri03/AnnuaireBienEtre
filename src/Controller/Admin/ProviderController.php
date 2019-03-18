<?php

namespace App\Controller\Admin;

use App\Entity\Provider;
use App\Form\ProviderType;
use App\Repository\ProviderRepository;
use App\Services\Mailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/admin/provider")
 */
class ProviderController extends AbstractController
{
    /**
     * @Route("/", name="provider_admin_index", methods={"GET"})
     */
    public function index(ProviderRepository $providerRepository): Response
    {
        return $this->render('admin/provider/index.html.twig', [
            'providers' => $providerRepository->findAll(),
        ]);
    }

    /**
     * @Route("/admin/provider/new", name="provider_admin_new", methods={"GET","POST"})
     */
    public function new(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $provider = new Provider();
        $form = $this->createForm(ProviderType::class, $provider);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $provider->setPassword(
                $passwordEncoder->encodePassword(
                    $provider,
                    $form->get('password'
                    )->getData()
                )
            );
            // fill in the time , user group and other data
            $provider->setInscriDate(new \DateTime());
            $provider->setBanned(0);
            $provider->setInscrActivated(1);
            $provider->setRoles(array('ROLE_PROVIDER'));
            $provider->setUnsucessfulTry(0);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($provider);
            $entityManager->flush();

            return $this->redirectToRoute('provider_index');
        }

        return $this->render('admin/provider/new.html.twig', [
            'provider' => $provider,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/provider/{id}", name="provider_admin_show", methods={"GET"})
     */
    public function show(Provider $provider): Response
    {
        return $this->render('admin/provider/show.html.twig', [
            'provider' => $provider,
        ]);
    }

    /**
     * @Route("/admin/provider/{id}/edit", name="provider_admin_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Provider $provider): Response
    {
        $form = $this->createForm(ProviderType::class, $provider);
        $form->remove('password');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $provider->setInscrActivated(1);
            $provider->setRoles(array('ROLE_PROVIDER'));
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('provider_admin_index', [
                'id' => $provider->getId(),
            ]);
        }

        return $this->render('admin/provider/edit.html.twig', [
            'provider' => $provider,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/provider/{id}", name="provider_admin_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Provider $provider): Response
    {
        if ($this->isCsrfTokenValid('delete'.$provider->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($provider);
            $entityManager->flush();
        }

        return $this->redirectToRoute('provider_admin_index');
    }
}
