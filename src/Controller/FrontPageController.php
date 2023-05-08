<?php

namespace App\Controller;
use App\Entity\Detail;
use App\Form\FrontDetailFormType;
use App\Repository\DetailRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class FrontPageController extends AbstractController
{

    private $detailRepository;
    private $em;

    public function __construct(DetailRepository $detailRepository , EntityManagerInterface $em){
        $this->detailRepository = $detailRepository;
        $this->em =$em;
    }
  
    //#[Route('/frontpage', methods:['GET'], name: 'app_front_page')]
    #[Route('/', methods:['GET'], name: 'details')]
    public function index(): Response
    {
        $details = $this->detailRepository->findAll();

        return $this->render('front_page/index.html.twig', [
            'details' => $details,
        ]);
    }

 
    #[Route('/CreateDetail', name:'create_detail')]
    public function create(Request $request): Response {
 
      $details = new Detail();
      $form =$this->createForm(FrontDetailFormType::class, $details);

      $form->handleRequest($request);
      
      if($form->isSubmitted() && $form->isValid()) {

        $newDetail = $form->getData();

        $imagePath= $form->get('imagePath')->getData();
       
        if($imagePath){
          $newFileName= uniqid() . '.'. $imagePath->guessExtension();   
         
          try{
               $imagePath->move(
                $this->getParameter('kernel.project_dir') . '/public/uploads',
                $newFileName
               );
          }catch(FileException $e){
           return new Response($e->getMessage());
          }

          $newDetail->setImagePath('/uploads/' . $newFileName);
        }
        $this->em->persist($newDetail);
        $this->em->flush();
        return $this->redirectToRoute('details');
      }
      
      return $this->render('front_page/create.html.twig',[
        'detailForm'=>$form->createView()
      ]);
    }
}
