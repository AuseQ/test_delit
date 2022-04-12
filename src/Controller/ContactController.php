<?php

namespace App\Controller;

use App\Entity\UserContact;
use App\Form\ContactFormType;
use App\Service\ContactService;
use DateTime;
use DateTimeImmutable;
use DateTimeZone;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route('/', name: 'app_contact')]
    public function index(Request $request,ContactService $contact_service): Response
    {

        $contact_form = $this->createForm(ContactFormType::class);

        $contact_form->handleRequest($request);

        if ($contact_form->isSubmitted()) {

            return $contact_service->handleFormData($contact_form);
        }


        return $this->renderForm('contact/index.html.twig', [
            'contact_form' => $contact_form,
        ]);
    }
}
