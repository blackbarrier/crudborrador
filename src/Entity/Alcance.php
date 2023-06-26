<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Alcance
 *
 * @ORM\Table(name="alcance")
 * @ORM\Entity
 */
class Alcance
{

    const NACIMIENTOS  = 1 ;
    const DEFUNCIONES = 2 ;
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
     * @var int
     *
     * @ORM\Column(name="borrado", type="integer", nullable=false, options={"comment"="0: activo - 1: borrado"})
     */
    private $borrado = '0';

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

    public function getBorrado(): ?int
    {
        return $this->borrado;
    }

    public function setBorrado(int $borrado): self
    {
        $this->borrado = $borrado;

        return $this;
    }


}
