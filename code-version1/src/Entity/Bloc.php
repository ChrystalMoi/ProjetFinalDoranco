<?php

namespace App\Entity;

use App\Repository\BlocRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BlocRepository::class)]
class Bloc
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom_bloc = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $observation_bloc = null;

    #[ORM\Column(length: 5)]
    private ?string $cotation_bloc = null;

    #[ORM\Column(length: 50)]
    private ?string $type_paroie_bloc = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 15, scale: 10)]
    private ?string $latitude_bloc = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 15, scale: 10)]
    private ?string $longitude_bloc = null;

    #[ORM\Column]
    private ?int $code_postal_bloc = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $ville_bloc = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $adresse_bloc = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomBloc(): ?string
    {
        return $this->nom_bloc;
    }

    public function setNomBloc(string $nom_bloc): self
    {
        $this->nom_bloc = $nom_bloc;

        return $this;
    }

    public function getObservationBloc(): ?string
    {
        return $this->observation_bloc;
    }

    public function setObservationBloc(?string $observation_bloc): self
    {
        $this->observation_bloc = $observation_bloc;

        return $this;
    }

    public function getCotationBloc(): ?string
    {
        return $this->cotation_bloc;
    }

    public function setCotationBloc(string $cotation_bloc): self
    {
        $this->cotation_bloc = $cotation_bloc;

        return $this;
    }

    public function getTypeParoieBloc(): ?string
    {
        return $this->type_paroie_bloc;
    }

    public function setTypeParoieBloc(string $type_paroie_bloc): self
    {
        $this->type_paroie_bloc = $type_paroie_bloc;

        return $this;
    }

    public function getLatitudeBloc(): ?string
    {
        return $this->latitude_bloc;
    }

    public function setLatitudeBloc(string $latitude_bloc): self
    {
        $this->latitude_bloc = $latitude_bloc;

        return $this;
    }

    public function getLongitudeBloc(): ?string
    {
        return $this->longitude_bloc;
    }

    public function setLongitudeBloc(string $longitude_bloc): self
    {
        $this->longitude_bloc = $longitude_bloc;

        return $this;
    }

    public function getCodePostalBloc(): ?int
    {
        return $this->code_postal_bloc;
    }

    public function setCodePostalBloc(int $code_postal_bloc): self
    {
        $this->code_postal_bloc = $code_postal_bloc;

        return $this;
    }

    public function getVilleBloc(): ?string
    {
        return $this->ville_bloc;
    }

    public function setVilleBloc(?string $ville_bloc): self
    {
        $this->ville_bloc = $ville_bloc;

        return $this;
    }

    public function getAdresseBloc(): ?string
    {
        return $this->adresse_bloc;
    }

    public function setAdresseBloc(?string $adresse_bloc): self
    {
        $this->adresse_bloc = $adresse_bloc;

        return $this;
    }
}
