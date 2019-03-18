<?php

namespace App\Controller;

use App\Entity\Provider;
use App\Entity\Surfer;
use App\Form\ProviderType;
use App\Form\SurferType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class RegisterController extends AbstractController
{

    //register as a Provider
    /**
     * @Route("/register/provider/{id}", name="provider_register", methods={"GET","POST"},  requirements={"id":"\d+"})
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

            return $this->redirectToRoute('app_login', [
                'id' => $provider->getId(),
            ]);
        }

        return $this->render('register/provider/new.html.twig', [
            'provider' => $provider,
            'form' => $form->createView(),
        ]);
    }

    //register as a surfer
    /**
     * @Route("/register/surfer/{id}", name="surfer_register", methods={"GET","POST"},  requirements={"id":"\d+"})
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

            return $this->redirectToRoute('app_login', [
                'id' => $surfer->getId(),
            ]);
        }
        return $this->render('register/surfer/edit.html.twig', [
            'surfer' => $surfer,
            'form' => $form->createView(),
        ]);
    }



}
