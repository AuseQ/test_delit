<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserContactRepository;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserContactRepository::class)]
class UserContact
{
    const SUCCESS = 'SUCCESS';
    const INVALID = 'INVALID';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[Assert\NotBlank(message: "les champs doivent êtres remplis")]
    #[Assert\Length(min:2, max:255, exactMessage:'Le champ "Nom" doit contenir entre 2 et 255 caractère.')]
    #[ORM\Column(type: 'string', length: 255)]
    private $user_lastname;

    #[Assert\NotBlank]
    #[Assert\Length(min:2, max:255, exactMessage:'Le champ "Prénom" doit contenir entre 2 et 255 caractère.')]
    #[ORM\Column(type: 'string', length: 255)]
    private $user_firstname;

    #[Assert\NotBlank]
    #[Assert\Length(min:2, max:255, exactMessage:'Le champ "Email" doit contenir entre 2 et 255 caractère.')]
    #[ORM\Column(type: 'string', length: 255)]
    private $user_mail;

    #[ORM\Column(type: 'string', length: 255)]
    private $object;

    #[Assert\NotBlank]
    #[ORM\Column(type: 'text')]
    private $message;

    #[Assert\DateTime]
    #[ORM\Column(type: 'datetime_immutable')]
    private $send_at;

    #[Assert\Type(
        type: "integer",
        message: "Le numéro de téléphone n'est pas valide.",)]
    #[ORM\Column(type: 'integer',length: 12)]
    private $user_phone_number;

    /* -------------------------------GETTERS ET SETTERS-------------------------------- */

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserLastname(): ?string
    {
        return $this->user_lastname;
    }

    public function setUserLastname(string $user_lastname): self
    {
        $this->user_lastname = $user_lastname;

        return $this;
    }

    public function getUserFirstname(): ?string
    {
        return $this->user_firstname;
    }

    public function setUserFirstname(string $user_firstname): self
    {
        $this->user_firstname = $user_firstname;

        return $this;
    }

    public function getUserMail(): ?string
    {
        return $this->user_mail;
    }

    public function setUserMail(string $user_mail): self
    {
        $this->user_mail = $user_mail;

        return $this;
    }

    public function getObject(): ?string
    {
        return $this->object;
    }

    public function setObject(string $object): self
    {
        $this->object = $object;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getSendAt(): ?\DateTimeImmutable
    {
        return $this->send_at;
    }

    public function setSendAt(\DateTimeImmutable $send_at): self
    {
        $this->send_at = $send_at;

        return $this;
    }

    public function getUserPhoneNumber(): ?int
    {
        return $this->user_phone_number;
    }

    public function setUserPhoneNumber(int $user_phone_number): self
    {
        $this->user_phone_number = $user_phone_number;

        return $this;
    }
}
