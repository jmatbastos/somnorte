<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\SeriesRepository;
use App\Repository\UserRepository;

class RegistrationController extends AbstractController
{
    
    private $series_repository;
    private $user_repository;    
	
	public function __construct(SeriesRepository $series_repository, UserRepository $user_repository)
    {  
        $this->series_repository = $series_repository;
        $this->user_repository = $user_repository;        
    }
    
    
    
    #[Route('/register', name: 'register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $user->setRoles( array($form->get('roles')->getData()) );
            $user->setName( $form->get('name')->getData() );
            $user->setNIF( $form->get('nif')->getData() );

            $entityManager->persist($user);
            $entityManager->flush();

            // do anything else you need here, like send an email

            $this->addFlash(
                'notice',
                'Success: New user registered!'
            );

            return $this->redirectToRoute('app_home');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form,
        ]);
    }

    #[Route('/user/show', name: 'user_show')]
    public function user_show(Request $request): Response
    {
        if ( $this->getUser() )
        { 

            $data['users'] = $this->user_repository->get_users();

            for ($i=0; $i<count($data['users']); $i++) {
                if($data['users'][$i]['roles'] == '["ROLE_ACTOR"]') $data['users'][$i]['roles'] = 'ACTOR';
                if($data['users'][$i]['roles'] == '["ROLE_DIRECTOR"]') $data['users'][$i]['roles'] = 'DIRECTOR';
                if($data['users'][$i]['roles'] == '["ROLE_ADMIN"]') $data['users'][$i]['roles'] = 'ADMINISTRATOR';
                if($data['users'][$i]['roles'] == '["ROLE_CLIENT"]') $data['users'][$i]['roles'] = 'CLIENT';
            }

            return $this->render('registration/show.html.twig', $data);
        }

        return $this->redirectToRoute('app_login');

    }

    #[Route('/user/delete/{user_id}', name: 'user_delete')]
    public function user_delete($user_id): Response
    {
        if ( $this->getUser() )
        { 
            
            if ( $this->series_repository->get_series_by_user_ID($user_id) )
			$this->addFlash(
				'warning', 'Permission denied, user is owner of Series' 
			);            
            else {
                $this->user_repository->delete_user($user_id);            
                $this->addFlash(
                    'notice',
                    'Success: User deleted!'
                );

            }
            return $this->redirectToRoute('user_show');
        }
        return $this->redirectToRoute('app_home');
    }
}
