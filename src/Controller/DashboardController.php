<?php

namespace App\Controller;

use App\Entity\UserContact;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(ManagerRegistry $em): Response
    {
        $fetched_contacts = $em->getRepository(UserContact::class)->findAll();


        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
            "fetched_contacts" => $fetched_contacts
        ]);
    }
}
