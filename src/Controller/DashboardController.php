<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
   
     #[Route('/UserDashboard', methods:['GET'], name: 'u_dashb')]
    public function getUserDash(){
        return $this->render('dashboard/user_dashboard.html.twig');
    }


     #[Route('/Dashboard', methods:['GET'], name: 'a_dashb')]
    public function getAdmnDash(){
        return $this->render('dashboard/admin_dashboard.html.twig');
    }

}
