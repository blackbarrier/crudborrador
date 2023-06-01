<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Distrito
 *
 * @ORM\Table(name="distrito", indexes={@ORM\Index(name="distrito_tipo_matricula_id", columns={"tipo_matricula_id"})})
 * @ORM\Entity
 */
class Distrito
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
     * @ORM\Column(name="nombre", type="string", length=45, nullable=false)
     */
    private $nombre;

    /**
     * @var \TipoMatricula
     *
     * @ORM\ManyToOne(targetEntity="TipoMatricula")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipo_matricula_id", referencedColumnName="id")
     * })
     */
    private $tipoMatricula;

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

    public function getTipoMatricula(): ?TipoMatricula
    {
        return $this->tipoMatricula;
    }

    public function setTipoMatricula(?TipoMatricula $tipoMatricula): self
    {
        $this->tipoMatricula = $tipoMatricula;

        return $this;
    }


}
