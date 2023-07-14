<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Repository\UserRepository;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type:'integer')]
    private ?int $id;

    #[ORM\Column(type: 'string', length: 255, unique:true)]
    private ?string $email = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $nom = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $prenom = null;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    #[ORM\Column(type: 'string', length: 255)]
    private ?string $password = null;

    #[ORM\Column(type: 'integer')]
    private int $role = 0;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $this->password = $hashedPassword;

        return $this;
    }

    public function getRole(): int
    {
        return $this->role;
    }

    public function setRole(int $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getRoles(): array
    {
        return [$this->role];
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    public function getSalt(): ?string
    {
        return null;
    }

    public function eraseCredentials(): void
    {
        // La méthode eraseCredentials() doit être vide, car nous utilisons Bcrypt pour le hachage des mots de passe.
        // Il n'est pas nécessaire de manipuler manuellement le mot de passe en clair.
    }

    public function getUsername(): ?string
    {
        return $this->email;
    }
}
