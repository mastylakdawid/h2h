<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContactRepository::class)]
class Contact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message : "Podaj imię")]
    private $firstName;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message : "Podaj nazwisko")]
    private $lastName;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message : "Podaj adres e-mail")]
    #[Assert\Email(message : "Podany adres jest nieprawidłowy")]
    private $email;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message : "Wybierz temat")]
    private $subiect;

    #[ORM\Column(type: 'text')]
    #[Assert\NotBlank(message : "Podaj treść wiadomości")]
    private $message;

    #[ORM\Column(type: 'datetime')]
    private $createAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getSubiect(): ?string
    {
        return $this->subiect;
    }

    public function setSubiect(string $subiect): self
    {
        $this->subiect = $subiect;

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

    public function getCreateAt(): ?\DateTimeInterface
    {
        return $this->createAt;
    }

    public function setCreateAt(\DateTimeInterface $createAt): self
    {
        $this->createAt = $createAt;

        return $this;
    }
}
