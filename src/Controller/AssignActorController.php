<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\CharacterRepository;
use App\Repository\PersonasRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;

class AssignActorController extends AbstractController
{
    
    private $character_repository;
    private $personas_repository;  
    private $user_repository;      
	
	public function __construct(CharacterRepository $character_repository, PersonasRepository $personas_repository, UserRepository $user_repository)
    {
        $this->character_repository = $character_repository;
        $this->personas_repository = $personas_repository;     
        $this->user_repository = $user_repository;           
    }
     
    
    #[Route('/assign/actor', name: 'app_assign_actor')]
    public function assign(Request $request): Response
    {
        if ( $this->getUser() )
        { 
        
            if ( $request->isMethod('POST') ) {
            
                $token = $request->get("csrf_token");

                if (!$this->isCsrfTokenValid('assign', $token))
                {
                    return new Response("Operation not allowed",  Response::HTTP_BAD_REQUEST,
                        ['content-type' => 'text/plain']);
                }

                $actors = $request->get("actors");
                $characters = $request->get("characters");


                
                if ($characters!= NULL && $actors !=NULL) {
                    $this->personas_repository->assign_actor($actors,$characters);
                    //return $this->redirectToRoute('app_home');
                    exit();
                }
                $this->addFlash(
                    'notice',
                    'Error: Please select at least one character and one actor!'
                );
                
            }

            // Method is GET
            $data['characters'] = $this->personas_repository->get_personas('P_10');
            $data['actors'] = $this->user_repository->get_actors();
            return $this->render('assign_actor/assign.html.twig', $data);
        }

        		
        return $this->redirectToRoute('app_login');
    }

    #[Route('/assign/show', name: 'app_assign_actor_show')]
    public function show(): Response
    {
        
        $data['episodes'] = $this->character_repository->get_episodes();

        return $this->render('assign_actor/show.html.twig', $data);
    }
}
