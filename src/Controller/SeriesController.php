<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\SeriesRepository;
use Symfony\Component\HttpFoundation\Request;

class SeriesController extends AbstractController
{
    
    private $series_repository;
	
	public function __construct(SeriesRepository $series_repository)
    {
        $this->series_repository = $series_repository;
    }
    
    #[Route('/series', name: 'app_series')]
    public function series(Request $request): Response
    {
        if ( $this->getUser() )
        { 
        
            if ( $request->isMethod('POST') ) {
            
                $token = $request->get("csrf_token");

                if (!$this->isCsrfTokenValid('series', $token))
                {
                    return new Response("Operation not allowed",  Response::HTTP_BAD_REQUEST,
                        ['content-type' => 'text/plain']);
                }

                $ref = $request->get("ref");
                $name = $request->get("name");
                $client = $request->get("client");


                $this->series_repository->create_series($ref,$name,$client);


                return $this->redirectToRoute('app_home');
                
            }


            $data['clients'] = $this->series_repository->get_clients();
            return $this->render('series/index.html.twig', $data);
        }

        		
        return $this->redirectToRoute('app_login');
    }
}
