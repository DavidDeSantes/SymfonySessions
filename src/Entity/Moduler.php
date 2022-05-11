<?php

namespace App\Entity;

use App\Repository\ModulerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ModulerRepository::class)
 */
class Moduler
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbJoursCours;

    /**
     * @ORM\ManyToOne(targetEntity=Cours::class, inversedBy="modulers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cours;

    /**
     * @ORM\ManyToOne(targetEntity=Session::class, inversedBy="modulers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $session;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbJoursCours(): ?int
    {
        return $this->nbJoursCours;
    }

    public function setNbJoursCours(int $nbJoursCours): self
    {
        $this->nbJoursCours = $nbJoursCours;

        return $this;
    }

    public function getCours(): ?Cours
    {
        return $this->cours;
    }

    public function setCours(?Cours $cours): self
    {
        $this->cours = $cours;

        return $this;
    }

    public function getSession(): ?Session
    {
        return $this->session;
    }

    public function setSession(?Session $session): self
    {
        $this->session = $session;

        return $this;
    }
}


