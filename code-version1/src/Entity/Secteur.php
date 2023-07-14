<?php

namespace App\Entity;

use App\Repository\SecteurRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SecteurRepository::class)]
class Secteur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom_secteur = null;

    #[ORM\Column]
    private ?int $num_secteur = null;

    #[ORM\Column(length: 255)]
    private ?string $region_secteur = null;

    #[ORM\Column(length: 255)]
    private ?string $pays_secteur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomSecteur(): ?string
    {
        return $this->nom_secteur;
    }

    public function setNomSecteur(string $nom_secteur): self
    {
        $this->nom_secteur = $nom_secteur;

        return $this;
    }

    public function getNumSecteur(): ?int
    {
        return $this->num_secteur;
    }

    public function setNumSecteur(int $num_secteur): self
    {
        $this->num_secteur = $num_secteur;

        return $this;
    }

    public function getRegionSecteur(): ?string
    {
        return $this->region_secteur;
    }

    public function setRegionSecteur(string $region_secteur): self
    {
        $this->region_secteur = $region_secteur;

        return $this;
    }

    public function getPaysSecteur(): ?string
    {
        return $this->pays_secteur;
    }

    public function setPaysSecteur(string $pays_secteur): self
    {
        $this->pays_secteur = $pays_secteur;

        return $this;
    }
}
