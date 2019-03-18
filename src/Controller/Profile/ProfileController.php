<?php

namespace App\Controller\Profile;

use App\Entity\Provider;
use App\Entity\Surfer;
use App\Form\ProviderType;
use App\Form\SurferType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/profile")
 */
class ProfileController extends AbstractController
{
    //As a Provider

        /**
         * @Route("/provider/{id}", name="provider_profile_show", methods={"GET"})
         */
        public function showProvider(Provider $provider): Response
        {
            return $this->render('profile/provider/show.html.twig', [
                'provider' => $provider,
            ]);
        }

        /**
         * @Route("/provider/{id}/edit", name="provider_profile_edit", methods={"GET","POST"})
         */
        public function editProvider(Request $request, Provider $provider): Response
        {
            $form = $this->createForm(ProviderType::class, $provider);
            $form->remove('password');
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $provider->setInscrActivated(1);
                $provider->setRoles(array('ROLE_PROVIDER'));

                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('provider_profile_show', [
                    'id' => $provider->getId(),
                ]);
            }

            return $this->render('profile/provider/edit.html.twig', [
                'provider' => $provider,
                'form' => $form->createView(),
            ]);
        }

    //as a Surfer

        /**
         * @Route("/surfer/{id}", name="surfer_profile_show", methods={"GET"})
         */
        public function showSurfer(Surfer $surfer): Response
        {
            return $this->render('profile/surfer/show.html.twig', [
                'surfer' => $surfer,
            ]);
        }

        /**
         * @Route("/surfer/{id}/edit", name="surfer_profile_edit", methods={"GET","POST"})
         */
        public function editSurfer(Request $request, Surfer $surfer): Response
        {
            $form = $this->createForm(SurferType::class, $surfer);
            $form->remove('password');
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $surfer->setInscrActivated(1);
                $surfer->setRoles(array('ROLE_SURFER'));

                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('surfer_profile_show', [
                    'id' => $surfer->getId(),
                ]);
            }

            return $this->render('profile/surfer/edit.html.twig', [
                'surfer' => $surfer,
                'form' => $form->createView(),
            ]);
        }
}
