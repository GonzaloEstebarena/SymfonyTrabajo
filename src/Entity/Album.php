<?php

namespace App\Entity;

use App\Repository\AlbumRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AlbumRepository::class)]
class Album
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'genre', targetEntity: Canciones::class)]
    private Collection $name;

    public function __construct()
    {
        $this->name = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Canciones>
     */
    public function getName(): Collection
    {
        return $this->name;
    }

    public function addName(Canciones $name): self
    {
        if (!$this->name->contains($name)) {
            $this->name->add($name);
            $name->setGenre($this);
        }

        return $this;
    }

    public function removeName(Canciones $name): self
    {
        if ($this->name->removeElement($name)) {
            // set the owning side to null (unless already changed)
            if ($name->getGenre() === $this) {
                $name->setGenre(null);
            }
        }

        return $this;
    }
}
