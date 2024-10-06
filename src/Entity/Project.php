<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'projectt', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: true)]
    private ?Image $image = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $link = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $step1 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $step2 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $step3 = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $githubLink = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage(Image $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): static
    {
        $this->link = $link;

        return $this;
    }

    public function getStep1(): ?string
    {
        return $this->step1;
    }

    public function setStep1(?string $step1): static
    {
        $this->step1 = $step1;

        return $this;
    }

    public function getStep2(): ?string
    {
        return $this->step2;
    }

    public function setStep2(?string $step2): static
    {
        $this->step2 = $step2;

        return $this;
    }

    public function getStep3(): ?string
    {
        return $this->step3;
    }

    public function setStep3(?string $step3): static
    {
        $this->step3 = $step3;

        return $this;
    }

    public function getGithubLink(): ?string
    {
        return $this->githubLink;
    }

    public function setGithubLink(?string $githubLink): static
    {
        $this->githubLink = $githubLink;

        return $this;
    }
}
