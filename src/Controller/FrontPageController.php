<?php

namespace App\Controller;
use App\Entity\Detail;
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
    #[Route('/frontpage', methods:['GET'], name: 'details')]
    public function index(): Response
    {
        $details = $this->detailRepository->findAll();

        return $this->render('front_page/index.html.twig', [
            'details' => $details,
        ]);
    }

   
}
