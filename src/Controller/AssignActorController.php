<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\CharacterRepository;
use Symfony\Component\HttpFoundation\Request;

class AssignActorController extends AbstractController
{
    
    private $character_repository;
	
	public function __construct(CharacterRepository $character_repository)
    {
        $this->character_repository = $character_repository;
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

                $actor_id = $request->get("actor");
                $characters = $request->get("characters");



                $this->character_repository->assign_actor($actor_id,$characters);


                return $this->redirectToRoute('app_assign_actor_show');
                
            }

            $data['characters'] = $this->character_repository->get_characters();
            $data['actors'] = $this->character_repository->get_actors();
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
