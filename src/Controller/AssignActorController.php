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
                    return $this->redirectToRoute('app_assign_actor_show');
                }
                $this->addFlash(
                    'notice',
                    'Error: Please select at least one character and one actor!'
                );
                
            }

            // Method is GET
            $session = $request->getSession();
            $serie_id = $session->get('serie_id');                       
            $data['characters'] = $this->personas_repository->get_personas($serie_id);           
            $data['actors'] = $this->user_repository->get_actors();
            return $this->render('assign_actor/assign.html.twig', $data);
        }

        		
        return $this->redirectToRoute('app_login');
    }

    #[Route('/assign/show', name: 'app_assign_actor_show')]
    public function show(Request $request): Response
    {
        if ( $this->getUser() )
        { 

            $session = $request->getSession();
            $serie_id = $session->get('serie_id');
            $data['episodes'] = $this->personas_repository->get_episodes($serie_id);
            $actors = $this->personas_repository->get_persona_in_episode_has_actor();
            for ($i=0; $i<count($data['episodes']); $i++) {
                for ($j=0; $j<count($actors); $j++) {
                    if( $data['episodes'][$i]['id'] == $actors[$j]['episode_id'] )
                        $data['episodes'][$i]['actor_name'] = $actors[$j]['actor_name'];
                }               
            }



            return $this->render('assign_actor/show.html.twig', $data);
        }

        return $this->redirectToRoute('app_login');

    }

    #[Route('/assign/change/{episode_id}', name: 'app_assign_actor_change')]
    public function change(Request $request, $episode_id): Response
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

                $episode_id = $request->get("episode_id");
                $persona_id = $request->get("char_id");
                $actor_id = $request->get("actor_id");  




                $this->personas_repository->persona_in_episode_has_actor($episode_id, $persona_id, $actor_id);
                return $this->redirectToRoute('app_assign_actor_show');


                
            }        
            
            // Method is GET
            $session = $request->getSession();
            $serie_id = $session->get('serie_id');
            $data['episodes'] = $this->personas_repository->get_episodes($serie_id);
            $data['actors'] = $this->user_repository->get_actors();
            $data['episode_id'] = $episode_id;

            $actors = $this->personas_repository->get_persona_in_episode_has_actor();
            for ($i=0; $i<count($data['episodes']); $i++) {
                for ($j=0; $j<count($actors); $j++) {
                    if( $data['episodes'][$i]['id'] == $actors[$j]['episode_id'] )
                        $data['episodes'][$i]['actor_name'] = $actors[$j]['actor_name'];
                }               
            }

            return $this->render('assign_actor/change.html.twig', $data);
        }

        return $this->redirectToRoute('app_login');

    }    
}
