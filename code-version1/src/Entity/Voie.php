<?php

namespace App\Entity;

use App\Repository\VoieRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VoieRepository::class)]
class Voie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom_voie = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $observation_voie = null;

    #[ORM\Column(length: 5)]
    private ?string $cotation_voie = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $hauteur_voie = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $type_paroie_voie = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 15, scale: 10)]
    private ?string $latitude_voie = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 15, scale: 10)]
    private ?string $longitude_voie = null;

    #[ORM\Column]
    private ?int $code_postal_voie = null;

    #[ORM\Column(length: 50)]
    private ?string $ville_voie = null;

    #[ORM\Column(length: 50)]
    private ?string $adresse_voie = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomVoie(): ?string
    {
        return $this->nom_voie;
    }

    public function setNomVoie(string $nom_voie): self
    {
        $this->nom_voie = $nom_voie;

        return $this;
    }

    public function getObservationVoie(): ?string
    {
        return $this->observation_voie;
    }

    public function setObservationVoie(?string $observation_voie): self
    {
        $this->observation_voie = $observation_voie;

        return $this;
    }

    public function getCotationVoie(): ?string
    {
        return $this->cotation_voie;
    }

    public function setCotationVoie(string $cotation_voie): self
    {
        $this->cotation_voie = $cotation_voie;

        return $this;
    }

    public function getHauteurVoie(): ?string
    {
        return $this->hauteur_voie;
    }

    public function setHauteurVoie(string $hauteur_voie): self
    {
        $this->hauteur_voie = $hauteur_voie;

        return $this;
    }

    public function getTypeParoieVoie(): ?string
    {
        return $this->type_paroie_voie;
    }

    public function setTypeParoieVoie(?string $type_paroie_voie): self
    {
        $this->type_paroie_voie = $type_paroie_voie;

        return $this;
    }

    public function getLatitudeVoie(): ?string
    {
        return $this->latitude_voie;
    }

    public function setLatitudeVoie(string $latitude_voie): self
    {
        $this->latitude_voie = $latitude_voie;

        return $this;
    }

    public function getLongitudeVoie(): ?string
    {
        return $this->longitude_voie;
    }

    public function setLongitudeVoie(string $longitude_voie): self
    {
        $this->longitude_voie = $longitude_voie;

        return $this;
    }

    public function getCodePostalVoie(): ?int
    {
        return $this->code_postal_voie;
    }

    public function setCodePostalVoie(int $code_postal_voie): self
    {
        $this->code_postal_voie = $code_postal_voie;

        return $this;
    }

    public function getVilleVoie(): ?string
    {
        return $this->ville_voie;
    }

    public function setVilleVoie(string $ville_voie): self
    {
        $this->ville_voie = $ville_voie;

        return $this;
    }

    public function getAdresseVoie(): ?string
    {
        return $this->adresse_voie;
    }

    public function setAdresseVoie(string $adresse_voie): self
    {
        $this->adresse_voie = $adresse_voie;

        return $this;
    }
}
