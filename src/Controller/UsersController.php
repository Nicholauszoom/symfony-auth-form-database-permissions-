<?php

namespace App\Controller;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsersController extends AbstractController
{
 private $userRepository;
    private $em;

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

}
