<?php

namespace App\Entity;

use App\Repository\CoursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CoursRepository::class)
 */
class Cours
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nomCours;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="cours")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;

    /**
     * @ORM\OneToMany(targetEntity=Moduler::class, mappedBy="cours")
     */
    private $modulers;

    public function __construct()
    {
        $this->modulers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCours(): ?string
    {
        return $this->nomCours;
    }

    public function setNomCours(string $nomCours): self
    {
        $this->nomCours = $nomCours;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection<int, Moduler>
     */
    public function getModulers(): Collection
    {
        return $this->modulers;
    }

    public function addModuler(Moduler $moduler): self
    {
        if (!$this->modulers->contains($moduler)) {
            $this->modulers[] = $moduler;
            $moduler->setCours($this);
        }

        return $this;
    }

    public function removeModuler(Moduler $moduler): self
    {
        if ($this->modulers->removeElement($moduler)) {
            // set the owning side to null (unless already changed)
            if ($moduler->getCours() === $this) {
                $moduler->setCours(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
      return $this->nomCours;  
    }
}
