<?php
namespace App\Service;

use App\Entity\UserContact;
use DateTimeImmutable;
use DateTimeZone;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class ContactService {
    public function __construct(private EntityManagerInterface $em){

    }

    public function handleFormData(FormInterface $form) : JsonResponse
    {

        if ($form->isValid()) {

            return $this->formIsValid($form);

        } else {

            return $this->formIsInvalid($form);

        }
        

    }

    public function formIsValid(FormInterface $form) : JsonResponse
    {

        /** @var UserContact $data */
        $data = $form->getData();

        $data->setSendAt(new DateTimeImmutable("now", new DateTimeZone("Europe/Paris")));

        $data->setObject("Demande contact de : ".$data->getUserFirstname()." ".$data->getUserLastname());

        $this->em->persist($data);
        $this->em->flush();

        return new JsonResponse([
            'code' => UserContact::SUCCESS,
            'html' => '<p>Votre formulaire de contact a bien été envoyé.</p>'
        ]);

    }

    public function formIsInvalid(FormInterface $form) : JsonResponse
    {
        return new JsonResponse([
            'code' => UserContact::INVALID,
            'errors' => $this->getErrorMessages($form)
        ]);
    }
    private function getErrorMessages(FormInterface $form){

        $errors = [];

        foreach ($form->getErrors() as $error) {
            $errors[] = $error->getMessage();
        }

        foreach ($form->all() as $child) {
            if (!$child->isValid()) {
                $errors[$child->getName()] = $this->getErrorMessages($child);
            }
        }
        return $errors;

    }
}