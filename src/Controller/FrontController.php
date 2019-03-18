<?php

namespace App\Controller;

use App\Entity\Provider;
use App\Repository\ProviderRepository;
use App\Repository\ServiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{


    // List of service service all
        /**
         * @Route("/service", name="service_front_index", methods={"GET"})
         */
        public function servicesIndex(ServiceRepository $serviceRepository): Response
        {
            return $this->render('front/sevices_index.html.twig', [
                'services' => $serviceRepository->findAll(),
            ]);
        }

        //list of services used in Menu
        public function listService(ServiceRepository $serviceRepository): Response
        {
            return $this->render('front/listService.html.twig', [
                'services' => $serviceRepository->findAll(),
            ]);
        }

    //provider info and list
        /**
         * @Route("/provider", name="provider_front_index", methods={"GET"})
         */
        public function index(ProviderRepository $providerRepository): Response
        {
            return $this->render('front/index.html.twig', [
                'providers' => $providerRepository->findAll(),
            ]);
        }

        /**
         * @Route("/provider/{id}", name="provider_profile_show", methods={"GET"})
         */
        public function show(Provider $provider): Response
        {
            return $this->render('front/show.html.twig', [
                'provider' => $provider,
            ]);
        }


}
