<?php
namespace App\Entity;

use App\Repository\RecipRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: RecipRepository::class)]
#[ORM\HasLifecycleCallbacks] // Add this line to enable lifecycle callbacks
class Recip
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Title is required.")]
    #[Assert\Length(max: 255, maxMessage: "Title cannot exceed 255 characters.")]
    #[Assert\Length(min: 2, maxMessage: "Title cannot exceed 255 characters.")]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Slug is required.")]
    #[Assert\Regex(
        pattern: "/^[a-z0-9]+(?:-[a-z0-9]+)*$/",
        message: "Slug must contain only lowercase letters, numbers, and hyphens."
    )]
    private ?string $slug = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank(message: "Content is required.")]
    #[Assert\Length(min: 10, minMessage: "Content must be at least 10 characters.")]
    private ?string $content = null;

    // Declare the createdAt property once
    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(nullable: true)]
    #[Assert\GreaterThan(
        value: 0,
        message: "Duration must be a positive number."
    )]
    private ?int $duration = null;

    // New fields for ingredients and instructions
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Assert\Length(
        max: 1000,
        maxMessage: "Ingredients cannot exceed 1000 characters."
    )]
    private ?string $ingredients = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Assert\Length(
        max: 1000,
        maxMessage: "Instructions cannot exceed 1000 characters."
    )]
    private ?string $instructions = null;

    public function __construct()
    {
        // Set createdAt and updatedAt to the current date and time when a new entity is created
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable(); // Ensure updatedAt is set

        // Set default values for ingredients and instructions if not provided
        $this->ingredients = "Default ingredients list"; // Default value for ingredients
        $this->instructions = "Default cooking instructions"; // Default value for instructions
    }

    // Lifecycle callback for updating timestamps
    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function updateTimestamps(): void
    {
        // Always set updatedAt when persisting or updating
        $this->updatedAt = new \DateTimeImmutable();
    }

    // Getters and setters for the new fields
    public function getIngredients(): ?string
    {
        return $this->ingredients;
    }

    public function setIngredients(?string $ingredients): static
    {
        $this->ingredients = $ingredients;

        return $this;
    }

    public function getInstructions(): ?string
    {
        return $this->instructions;
    }

    public function setInstructions(?string $instructions): static
    {
        $this->instructions = $instructions;

        return $this;
    }

    // Existing getters and setters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): static
    {
        $this->duration = $duration;

        return $this;
    }
}
