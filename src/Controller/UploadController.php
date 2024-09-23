<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use App\Repository\CharacterRepository;
use App\Repository\PersonasRepository;
use App\Repository\EpisodesRepository;
use Symfony\Component\Filesystem\Filesystem;



class UploadController extends AbstractController
{
    
    

	private $validator;
    private $character_repository;
    private $personas_repository;	
    private $episodes_repository;	

	public function __construct(ValidatorInterface $validator, CharacterRepository $character_repository, PersonasRepository $personas_repository, EpisodesRepository $episodes_repository)
    {
        $this->validator = $validator;
        $this->character_repository = $character_repository;
        $this->personas_repository = $personas_repository;
        $this->episodes_repository = $episodes_repository;				
    }
    
    #[Route('/upload', name: 'upload')]
    public function index(Request $request): Response
    {
         
		if ($this->getUser())
		{ 
		 
		    if ($request->isMethod('POST') ) {
		 
				$token = $request->get("csrf_token");

			   if (!$this->isCsrfTokenValid('file', $token))
			   {
				   return new Response("Operation not allowed",  Response::HTTP_BAD_REQUEST,
					   ['content-type' => 'text/plain']);
			   }
		  
			   $file = $request->files->get('file');

			   if (empty($file))
			   {
				   return new Response("No file specified",
					   Response::HTTP_UNPROCESSABLE_ENTITY, ['content-type' => 'text/plain']);
			   }
			  
			   
			   
			   $filename = $file->getClientOriginalName();
			   
			   
			   $input = ['file' => $file];

			   $constraints = new Assert\Collection([
			   'file' => new Assert\File([
                    'maxSize' => '1024k',
					'maxSizeMessage' => 'The image is too large. Allowed maximum size is {{ limit }} {{ suffix }}',
                    'mimeTypes' => ['text/csv',],
                    'mimeTypesMessage' => 'Please upload a valid csv file',
			     ]),
			   ]);

				$data = $this->requestValidation($input, $constraints);
				  
				if ( $data['errors'] > 0)
					   return $this->render('upload/index.html.twig', $data);
				  				  

			   try {
				   $file->move("uploads", $filename);
			   } catch (FileException $e){
				   throw new FileException('Failed to upload file ' . $e->getMessage());
			   }

               // file upload success
               $filesystem = new Filesystem();
               $contents = $filesystem->readFile("/Users/jbastos/public_html/somnorte/uploads/$filename");

               $contents_array = explode(PHP_EOL,$contents);
               
               // insert into database

               //for($i=0; $i<count($contents_array); $i++)
               // $this->character_repository->insert_characters($contents_array[$i]);

			   for($i=0; $i<count($contents_array); $i++) {
					if (strlen($contents_array[$i]) != 0) {
						if ($i==0) 
							$contents_array[$i] = substr($contents_array[$i],3); 
						$this->personas_repository->insert_personas($contents_array[$i]);
						$this->episodes_repository->insert_episodes($contents_array[$i]); 
						$this->episodes_repository->insert_no_of_lines($contents_array[$i]);
					}					   
				}
			

				$this->addFlash(
                    'notice',
                    'Success: CVS File uploaded!'
                );
			   
			   return $this->redirectToRoute('app_home');
			 
			} 
			 
			 $data['errors'] = 0;
			 return $this->render('upload/index.html.twig', $data); 

		}
		
		return $this->redirectToRoute('app_login');
	}

    private function requestValidation($input, $constraints)
    {
       
            $violations = $this->validator->validate($input, $constraints);
       
                $errorMessages = [];
           
            if (count($violations) > 0) {
 
                $accessor = PropertyAccess::createPropertyAccessor();
 
                foreach ($violations as $violation) {
 
                    $accessor->setValue($errorMessages,
                        $violation->getPropertyPath(),
                        $violation->getMessage());
                }
           
            }   
                $data['errors'] = count($violations);
                $data['errorMessages'] = $errorMessages;
                 
            return $data;
    }
}
