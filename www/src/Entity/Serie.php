<?php

namespace App\Entity;

use App\Repository\SerieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SerieRepository::class)]
class Serie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $number_volume = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateStarted = null;

    #[ORM\Column]
    private ?bool $isFinished = null;

    #[ORM\Column(length: 255)]
    private ?string $imagePath = null;

    /**
     * @var Collection<int, Author>
     */
    #[ORM\ManyToMany(targetEntity: Author::class, inversedBy: 'series', cascade: ['persist'])]
    private Collection $authors;

    /**
     * @var Collection<int, Editor>
     */
    #[ORM\ManyToMany(targetEntity: Editor::class, inversedBy: 'series')]
    private Collection $editors;

    /**
     * @var Collection<int, Type>
     */
    #[ORM\ManyToMany(targetEntity: Type::class, inversedBy: 'series')]
    private Collection $types;

    /**
     * @var Collection<int, Book>
     */
    #[ORM\OneToMany(targetEntity: Book::class, mappedBy: 'serie')]
    private Collection $books;

    public function __construct()
    {
        $this->authors = new ArrayCollection();
        $this->editors = new ArrayCollection();
        $this->types = new ArrayCollection();
        $this->books = new ArrayCollection();
    }

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getNumberVolume(): ?int
    {
        return $this->number_volume;
    }

    public function setNumberVolume(int $number_volume): static
    {
        $this->number_volume = $number_volume;

        return $this;
    }

    public function getDateStarted(): ?\DateTimeInterface
    {
        return $this->dateStarted;
    }

    public function setDateStarted(\DateTimeInterface $dateStarted): static
    {
        $this->dateStarted = $dateStarted;

        return $this;
    }

    public function isFinished(): ?bool
    {
        return $this->isFinished;
    }

    public function setIsFinished(bool $isFinished): static
    {
        $this->isFinished = $isFinished;

        return $this;
    }
    
    public function getImagePath(): ?string
    {
        return $this->imagePath;
    }

    public function setImagePath(string $imagePath): static
    {
        $this->imagePath = $imagePath;

        return $this;
    }

    /**
     * @return Collection<int, Author>
     */
    public function getAuthors(): Collection
    {
        return $this->authors;
    }

    public function addAuthor(Author $author): static
    {
        if (!$this->authors->contains($author)) {
            $this->authors->add($author);
        }

        return $this;
    }

    public function removeAuthor(Author $author): static
    {
        $this->authors->removeElement($author);

        return $this;
    }

    /**
     * @return Collection<int, Editor>
     */
    public function getEditors(): Collection
    {
        return $this->editors;
    }

    public function addEditor(Editor $editor): static
    {
        if (!$this->editors->contains($editor)) {
            $this->editors->add($editor);
        }

        return $this;
    }

    public function removeEditor(Editor $editor): static
    {
        $this->editors->removeElement($editor);

        return $this;
    }

    /**
     * @return Collection<int, Type>
     */
    public function getTypes(): Collection
    {
        return $this->types;
    }

    public function addType(Type $type): static
    {
        if (!$this->types->contains($type)) {
            $this->types->add($type);
        }

        return $this;
    }

    public function removeType(Type $type): static
    {
        $this->types->removeElement($type);

        return $this;
    }

    /**
     * @return Collection<int, Book>
     */
    public function getBooks(): Collection
    {
        return $this->books;
    }

    public function addBook(Book $book): static
    {
        if (!$this->books->contains($book)) {
            $this->books->add($book);
            $book->setSerie($this);
        }

        return $this;
    }

    public function removeBook(Book $book): static
    {
        if ($this->books->removeElement($book)) {
            // set the owning side to null (unless already changed)
            if ($book->getSerie() === $this) {
                $book->setSerie(null);
            }
        }

        return $this;
    }
}
