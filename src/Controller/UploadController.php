<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class UploadController extends AbstractController
{
    
    

	private $validator;
    private $filesystem;
	
	public function __construct(ValidatorInterface $validator, Filesystem $filesystem)
    {
        $this->validator = $validator;
		$this->filesystem = $filesystem;
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

               // file upload success; 

               // insert into database

                $process = Process::fromShellCommandline('c:\xampp\mysql\bin\mysql.exe -usomnorte -pS0mn0rt somnorte < uploads\Book1.sql ');
                $process->run();

                // executes after the command finishes
                if (!$process->isSuccessful()) {
                    throw new ProcessFailedException($process);
                }

                echo $process->getOutput();

                //delete files
                /*
                $process = Process::fromShellCommandline('del uploads\Book1.sql ');
                $process->run();
                $process = Process::fromShellCommandline('del uploads\\' . $filename);
                $process->run();
                */

                exit();
			  
			   
			   // return $this->redirectToRoute('upload');
			 
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
