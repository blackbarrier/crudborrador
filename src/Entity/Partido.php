<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Partido
 *
 * @ORM\Table(name="partido")
 * @ORM\Entity
 */
class Partido
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100, nullable=false)
     */
    private $nombre;

    /**
     * @ORM\OneToMany(targetEntity=Delegacion::class, mappedBy="partido_id")
     */
    private $delegaciones;

    public function __construct()
    {
        $this->delegaciones = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * @return Collection<int, Delegacion>
     */
    public function getDelegaciones(): Collection
    {
        return $this->delegaciones;
    }

    public function addDelegacione(Delegacion $delegacione): self
    {
        if (!$this->delegaciones->contains($delegacione)) {
            $this->delegaciones[] = $delegacione;
            $delegacione->setPartidoId($this);
        }

        return $this;
    }

    public function removeDelegacione(Delegacion $delegacione): self
    {
        if ($this->delegaciones->removeElement($delegacione)) {
            // set the owning side to null (unless already changed)
            if ($delegacione->getPartidoId() === $this) {
                $delegacione->setPartidoId(null);
            }
        }

        return $this;
    }


}
