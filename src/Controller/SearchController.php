<?php

namespace App\Controller;

use App\Form\SearchType;
use App\Repository\ProviderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="search")
     */
    public function index(Request $request)
    {
        //AppBundle\Form\SearchType
        $form = $this->createForm(SearchType::class);
        $form->handleRequest($request);

        return $this->render('search/_searchBar.html.twig', [
            'form' => $form->createView()
        ]);
    }




    /**
     * @Route("/search/show", name="search_show")
     *
     */
    public function show(ProviderRepository $repository, Request $request)
    {
        //catch the searched term
        $search = $request->query->get('search');
        //Use the query builder to retrieve the result
        $results = $repository->findByNomLocalityService($search);

        return $this->render(
            'search/index.html.twig',
            [
                'search' => $search['search'],
                'results' => $results
            ]
        );
    }


}
