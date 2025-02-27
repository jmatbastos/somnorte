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
use App\Repository\InvoicesRepository;
use Symfony\Component\Filesystem\Filesystem;



class UploadInvoiceController extends AbstractController
{
    
    

	private $validator;
    private $invoices_repository;	

	public function __construct(ValidatorInterface $validator, InvoicesRepository $invoices_repository)
    {
        $this->validator = $validator;
        $this->invoices_repository = $invoices_repository;				
    }
    
    #[Route('/invoice/upload/{ref}', name: 'invoice_upload')]
    public function invoice_upload(Request $request, $ref): Response
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
		  
			   
               $type = $request->get("type");
               $value = $request->get("value");
               $date = $request->get("date");
			   $reference = $request->get("reference");
               
               
               $file = $request->files->get('file');

			   if (empty($file))
			   {
				   return new Response("No file specified",
					   Response::HTTP_UNPROCESSABLE_ENTITY, ['content-type' => 'text/plain']);
			   }
			  
			   
			   
			   $filename = substr(time(),-4) . $file->getClientOriginalName();
			   
			   
			   $input = ['file' => $file];

			   $constraints = new Assert\Collection([
			   'file' => new Assert\File([
                    'maxSize' => '10M',
					'maxSizeMessage' => 'The file is too large. Allowed maximum size is {{ limit }} {{ suffix }}',
                    'extensions' => ['pdf',],
                    'extensionsMessage' => 'Please upload a valid pdf file',
			     ]),
			   ]);

				$data = $this->requestValidation($input, $constraints);
				  
				if ( $data['errors'] > 0)
					   return $this->render('invoice/upload.html.twig', $data);
				  				  

			   try {
				   $file->move("uploads", $filename);
			   } catch (FileException $e){
				   throw new FileException('Failed to upload file ' . $e->getMessage());
			   }

               // file upload success	
               
               $this->invoices_repository->create_Invoices($this->getUser()->getId(), $ref, $reference, $type, $value, $date, $filename);

				$this->addFlash(
                    'notice',
                    'Success: Invoice File uploaded!'
                );
			   
			   return $this->redirectToRoute('cachets_show');
			 
			} 
			 
			 $data['errors'] = 0;
			 return $this->render('invoice/upload.html.twig', $data); 

		}
		
		return $this->redirectToRoute('app_login');
	}

	#[Route('/invoice/show/{ref}', name: 'invoice_show')]
    public function invoice_show($ref): Response
    {
        if ( $this->getUser() )
        { 
            $ref=urldecode($ref);
			$ref=str_replace("||", "/", $ref);
			$data['invoices'] = $this->invoices_repository->get_invoice($ref);

            return $this->render('invoice/show.html.twig', $data);
        }

        return $this->redirectToRoute('app_login');

    }

	#[Route('/invoice/download/{filename}', name: 'invoice_download')]
	 public function download($filename): Response
	 {
		 return $this->file("../public/uploads/$filename");
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

