<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\SeriesRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;

class SeriesController extends AbstractController
{
    
    private $series_repository;
    private $user_repository;
	
	public function __construct(SeriesRepository $series_repository, UserRepository $user_repository)
    {  
        $this->series_repository = $series_repository;
        $this->user_repository = $user_repository;
    }
    
    #[Route('/series/create', name: 'app_series_create')]
    public function series_create(Request $request): Response
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

                $this->addFlash(
                    'notice',
                    'Success: New series was created!'
                );


                return $this->redirectToRoute('app_home');
                
            }


            $data['clients'] = $this->user_repository->get_clients();
            return $this->render('series/create.html.twig', $data);
        }

        		
        return $this->redirectToRoute('app_login');
    }

    #[Route('/series/select', name: 'app_series_select')]
    public function series_select(Request $request): Response
    {
        if ( $this->getUser() )
        { 
            if ( $request->isMethod('POST') ) {
            
                $token = $request->get("csrf_token");

                if (!$this->isCsrfTokenValid('select', $token))
                {
                    return new Response("Operation not allowed",  Response::HTTP_BAD_REQUEST,
                        ['content-type' => 'text/plain']);
                }

                $serie_id = $request->get("serie_id");



                
                if ($serie_id!= NULL) {
                    $session = $request->getSession();
                    $session->set('serie_id', $serie_id);
                    return $this->redirectToRoute('app_home');
                }
                $this->addFlash(
                    'notice',
                    'Error: Please select one series!'
                );
                
            } 
            
            // METHOD IS GET
            $data['series'] = $this->series_repository->get_series();
            return $this->render('series/select.html.twig', $data);
        }
    }

}
