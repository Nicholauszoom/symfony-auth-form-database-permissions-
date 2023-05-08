<?php

namespace App\Controller;

use App\Entity\Officess;
use App\Form\OfficessFormType;
use App\Repository\OfficessRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OfficessController extends AbstractController
{
        private $officeRepository;
        private $em;

       public function __construct (OfficessRepository $officeRepository, EntityManagerInterface $em)
       {
        $this->officeRepository=$officeRepository;
         $this->em= $em;
     }

     #[Route('/office', name: 'office')]
     public function index(): Response
     {

         $office = $this->officeRepository->findAll();
         return $this->render('office/index.html.twig', [
             'office' => $office,
         ]); 
     }

     #[Route('/Create_Offce', name:'create_office')]
     public function createOffice(Request $request):Response
     {

         $office = new Officess();
         $form = $this->createForm(OfficessFormType::class, $office );
         $form->handleRequest($request);
         if($form->isSubmitted()){
        // After form is submitted
        // $category will be filled 
        // with data from $form
       $this->em->persist($office);
       $this->em->flush();
       
      return $this->redirectToRoute('office');

    }
        
    
      
         
         return $this->render('office/create.html.twig',[
         'officessForm'=>$form->createView()
       ]);
     }
    }
 



