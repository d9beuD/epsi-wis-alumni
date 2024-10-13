<?php

namespace App\Entity;

use App\Repository\MembershipRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MembershipRepository::class)]
class Membership
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(options: ['default' => false])]
    private ?bool $approved = null;

    #[ORM\OneToOne(mappedBy: 'membership', cascade: ['persist', 'remove'])]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isApproved(): ?bool
    {
        return $this->approved;
    }

    public function setApproved(bool $approved): static
    {
        $this->approved = $approved;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): static
    {
        // set the owning side of the relation if necessary
        if ($user->getMembership() !== $this) {
            $user->setMembership($this);
        }

        $this->user = $user;

        return $this;
    }
}
