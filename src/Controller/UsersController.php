<?php

namespace App\Controller;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;



class UsersController extends AbstractController
{
 private $userRepository;
    private $em;
    private $user;

      public function __construct(UserRepository $userRepository , EntityManagerInterface $em){
        $this->userRepository = $userRepository;
        $this->em =$em;
    }
  

    #[Route('/users',methods:['GET'], name: 'app_users')]
    public function index(): Response
    {
        $user=$this->userRepository->findAll();

        return $this->render('users/index.html.twig', [
            'app_users' => $user,
        ]);
    }

        //  Normal user dashboard inbox section

      #[Route('/UserInbox',methods:['GET'], name: 'u_inbox')]
    public function getUserInbox(): Response
    {
        // $user=$this->userRepository->findAll();

        return $this->render('users/inbox.html.twig');
    }


       #[Route('/users/edit/{id}', name: 'edit_user')]
    public function edit($id, Request $request): Response
    {

      $user = $this->userRepository->find($id);
      $form = $this->createForm(RegistrationFormType::class,$user);

        $form->handleRequest($request);
        $imagePath = $form->get('imagePath')->getData();

      if ($form->isSubmitted() && $form->isValid()) { 
          if($imagePath){
             if ($imagePath->getImagePath()!==null){
              if (file_exists(
                $this->getParameter('kernel.project_dir').$user->getImagePath()
              )) {
                $this->GetParameter('kernel.project_dir').$user->getImagePath();

                $newFileName = uniqid() . '.' . $imagePath->guessExtension();

                try{
                  $imagePath->move(
                   $this->getParameter('kernel.project_dir') . '/public/uploads',
                   $newFileName
                  );
             }catch(FileException $e){
              return new Response($e->getMessage());
             }
             $user->setImagePath('/uploads' . $newFileName);
            $this->em->flush();
            
            return $this->redirectToRoute('app_users');
        }

             }
          }else{
         $user->setFirstName($form->get('firstName')->getData());
         $user->setLastName($form->get('lastName')->getData());
         $user->setEmail($form->get('email')->getData());
           $user->setPassword($form->get('password')->getData());


         $this->em->flush();
        return $this->redirectToRoute('app_users');
      }
    }
        return $this->render('users/edit.html.twig',[
          'user'=> $user,
          'form'=>$form->createView()
        ]);
    }



}
