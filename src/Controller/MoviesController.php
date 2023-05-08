<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Form\MovieFormType;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MoviesController extends AbstractController
{

  private $movieRepository;
  private $em;

  public function __construct(MovieRepository $movieRepository , EntityManagerInterface $em){
      $this->movieRepository = $movieRepository;
      $this->em =$em;
  }
 
  // #[Route('/' , methods:['GET'])]
  // public function index2(): Response
  // {

  //     return $this->render('movies/index.html.twig');
  // }
  
  #[Route('/tailwindtest' , methods:['GET'])]
  public function getTailwind(): Response
  {

      return $this->render('movies/bootstrapandtailwind.html.twig');
  }


  #[Route('/contact' , methods:['GET'])]
  public function contact(): Response
  {

      return $this->render('components/contact.html.twig');
  }
 

    #[Route('/movies' , methods:['GET'], name: 'movies')]
    public function index(): Response
    {

      $movies = $this->movieRepository->findAll();

        return $this->render('movies/index.html.twig',[
          'movies'=> $movies
        ]);
    }

    #[Route('/movies/create', name:'create_movie')]
    public function create(Request $request): Response {
 
      $movie = new Movie();
      $form =$this->createForm(MovieFormType::class, $movie);

      $form->handleRequest($request);
      
      if($form->isSubmitted() && $form->isValid()) {

        $newMovie = $form->getData();

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

          $newMovie->setImagePath('/uploads/' . $newFileName);
        }
        $this->em->persist($newMovie);
        $this->em->flush();
        return $this->redirectToRoute('movies');
      }
      
      return $this->render('movies/create.html.twig',[
        'form'=>$form->createView()
      ]);
    }

    #[Route('/movies/edit/{id}', name: 'edit_movie')]
    public function edit($id, Request $request): Response
    {

      $movie = $this->movieRepository->find($id);
      $form = $this->createForm(MovieFormType::class,$movie);

        $form->handleRequest($request);
        $imagePath = $form->get('imagePath')->getData();

      if ($form->isSubmitted() && $form->isValid()) { 
          if($imagePath){
             if ($imagePath->getImagePath()!==null){
              if (file_exists(
                $this->getParameter('kernel.project_dir').$movie->getImagePath()
              )) {
                $this->GetParameter('kernel.project_dir').$movie->getImagePath();

                $newFileName = uniqid() . '.' . $imagePath->guessExtension();

                try{
                  $imagePath->move(
                   $this->getParameter('kernel.project_dir') . '/public/uploads',
                   $newFileName
                  );
             }catch(FileException $e){
              return new Response($e->getMessage());
             }
             $movie->setImagePath('/uploads' . $newFileName);
            $this->em->flush();
            
            return $this->redirectToRoute('movies');


              }

             }
          }else{
         $movie->setTitle($form->get('title')->getData());
         $movie->setDescription($form->get('description')->getData());
         $movie->setReleaseyYear($form->get('releaseyYear')->getData());


         $this->em->flush();
        return $this->redirectToRoute('movies');
      }
    }
        return $this->render('movies/edit.html.twig',[
          'movie'=> $movie,
          'form'=>$form->createView()
        ]);
    }


    #[Route('/movies/delete/{id}', methods:['GET', 'DELETE' ],name: 'delete_movie')]
    public function delete($id): Response {
      $movie  = $this->movieRepository->find($id);
      $this->em->remove($movie);
      $this->em->flush();
      return $this->redirectToRoute('movies');
    }

    #[Route('/movies/{id}',methods:['GET'], name: 'show_movie')]
    public function show($id): Response
    {

      $movie = $this->movieRepository->find($id);

        return $this->render('movies/show.html.twig',[
          'movie'=> $movie
        ]);
    }

    #[Route('/userDash',methods:['GET'], name: 'home')]
    public function getHome(): Response
    {
      
        return $this->render('movies/userDash.html.twig');
    }
}
