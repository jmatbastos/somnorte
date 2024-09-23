<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(Request $request): Response
    {
        
        if ($this->getUser()) 
            $data['user_logged_in'] = true;
        else 
            $data['user_logged_in'] = false;

        $session = $request->getSession();
        $data['serie_id'] = $session->get('serie_id', false);

        return $this->render('home/index.html.twig', $data);
    }
}
