<?php

namespace App\Controller;

use App\Entity\Building;
use App\Form\BuildingFormType;
use App\Repository\BuildingRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BuildingController extends AbstractController
{
  private $buildingRepository;
    private $em;

    public function __construct(BuildingRepository $buildingRepository , EntityManagerInterface $em){
        $this->buildingRepository = $buildingRepository;
        $this->em =$em;
    }
  
    //#[Route('/frontpage', methods:['GET'], name: 'app_front_page')]
    #[Route('/building', methods:['GET'], name: 'buildings')]
    public function index(): Response
    {
        $building = $this->buildingRepository->findAll();

        return $this->render('building/index.html.twig', [
            'buildings' => $building,
        ]);
    }


    #[Route('/building/{id}',methods:['GET'],name:'show_building')]
    public function show($id):Response
    {
        $building =$this->buildingRepository->find($id);

        return $this->render('building/show.html.twig',[
            'building'=>$building
        ]);
    }
 
    #[Route('/CreateBuilding', name:'create_building')]
    public function create(Request $request): Response {
 
      $building = new Building();
      $form =$this->createForm(BuildingFormType::class, $building);

      $form->handleRequest($request);
      
      if($form->isSubmitted() && $form->isValid()) {

        $newBuilding = $form->getData();

        $ImagePath= $form->get('ImagePath')->getData();
       
        if($ImagePath){
          $newFileName= uniqid() . '.'. $ImagePath->guessExtension();   
         
          try{
               $ImagePath->move(
                $this->getParameter('kernel.project_dir') . '/public/uploads',
                $newFileName
               );
          }catch(FileException $e){
           return new Response($e->getMessage());
          }

          $newBuilding->setImagePath('/uploads/' . $newFileName);
        }
        $this->em->persist($newBuilding);
        $this->em->flush();
        return $this->redirectToRoute('building');
      }
      
      return $this->render('building/create.html.twig',[
        'buildingForm'=>$form->createView()
      ]);
    }

    #[Route('/building/edit/{id}',name:'edit_building')]
       public function edit($id, Request $request):Response{
        $building= $this->buildingRepository->find($id);
        $form =$this->createForm(BuildingFormType::class,$building);

        $form->handleRequest($request);
           $ImagePath = $form->getImagePath('ImagePath')->getData();

           if ($form->isSubmitted() && $form->isValid()) {
               if($ImagePath){
                   if ($ImagePath->get()!==null){
                       if (file_exists(
                           $this->getParameter('kernel.project_dir').$building->getImagePath()
                       )) {
                           $this->GetParameter('kernel.project_dir').$building->getImagePath();

                           $newFileName = uniqid() . '.' . $ImagePath->guessExtension();

                           try{
                               $ImagePath->move(
                                   $this->getParameter('kernel.project_dir') . '/public/uploads',
                                   $newFileName
                               );
                           }catch(FileException $e){
                               return new Response($e->getMessage());
                           }
                           $building->setImagePath('/uploads' . $newFileName);
                           $this->em->flush();

                           return $this->redirectToRoute('buildings');


                       }

                   }
               }else{
                   $building->setName($form->get('name')->getData());
                   $building->setDescription($form->get('description')->getData());
                   $building->setCode($form->get('code')->getData());


                   $this->em->flush();
                   return $this->redirectToRoute('buildings');
               }
           }
           return $this->render('building/edit.html.twig',[
               'buildings'=> $building,
               'buildingForm'=>$form->createView()
           ]);
       }

}

