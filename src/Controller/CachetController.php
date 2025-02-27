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
use App\Repository\CachetsRepository;
use Symfony\Component\Filesystem\Filesystem;



class CachetController extends AbstractController
{
    
    

	private $validator;
    private $cachets_repository;	

	public function __construct(ValidatorInterface $validator, CachetsRepository $cachets_repository)
    {
        $this->validator = $validator;
        $this->cachets_repository = $cachets_repository;			
    }
    
    #[Route('/cachets/upload', name: 'cachets_upload')]
    public function cachets_upload(Request $request): Response
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
					'maxSizeMessage' => 'The file is too large. Allowed maximum size is {{ limit }} {{ suffix }}',
			     ]),
			   ]);

				$data = $this->requestValidation($input, $constraints);
				  
				if ( $data['errors'] > 0)
					   return $this->render('cachets/upload.html.twig', $data);
				  				  

			   try {
				   $file->move("uploads", $filename);
			   } catch (FileException $e){
				   throw new FileException('Failed to upload file ' . $e->getMessage());
			   }

               // file upload success
               $filesystem = new Filesystem();
			   $contents = $filesystem->readFile("c:\\xampp\\htdocs\\somnorte\\public\\uploads\\$filename");
               //$contents = $filesystem->readFile("/Users/jbastos/public_html/somnorte/uploads/$filename");
               //$contents = $filesystem->readFile("/var/www/html/somnorte/uploads/$filename");			   

               $contents_array = explode(PHP_EOL,$contents);
               
               // insert into database

               //for($i=0; $i<count($contents_array); $i++)
               // $this->character_repository->insert_characters($contents_array[$i]);

			   for($i=0; $i<count($contents_array); $i++) {
					if (strlen($contents_array[$i]) != 0) {
						if ($i==0 && $contents_array[$i][0]==0xEF && $contents_array[$i][1]==0xBB && $contents_array[$i][2]==0xBF) 
							$contents_array[$i] = substr($contents_array[$i],3); 
						    $this->cachets_repository->insert_users($contents_array[$i]);
						    $this->cachets_repository->insert_cachets($contents_array[$i]);                            
					}					   
				}
			

				$this->addFlash(
                    'notice',
                    'Success: CVS File uploaded!'
                );
			   
			   return $this->redirectToRoute('app_home');
			 
			} 
			 
			 $data['errors'] = 0;
			 return $this->render('cachets/upload.html.twig', $data); 

		}
		
		return $this->redirectToRoute('app_login');
	}

    #[Route('/cachets/show', name: 'cachets_show')]
    public function cachets_show(Request $request): Response
    {
        if ( $this->getUser() )
        { 
            $data['cachets'] = $this->cachets_repository->get_cachets();

            return $this->render('cachets/show.html.twig', $data);
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

