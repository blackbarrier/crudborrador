<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProfesionalRegistracionArchivo
 *
 * @ORM\Table(name="profesional_registracion_archivo", indexes={@ORM\Index(name="FK_profesional_registracion_archivo_profesional_registracion", columns={"profesional_registracion_id"})})
 * @ORM\Entity
 */
class ProfesionalRegistracionArchivo
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
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_carga", type="datetime", nullable=false)
     */
    private $fechaCarga;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=100, nullable=false)
     */
    private $path = '';

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_archivo", type="string", length=100, nullable=false)
     */
    private $nombreArchivo = '';

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_archivo", type="string", length=50, nullable=false)
     */
    private $tipoArchivo = '';

    /**
     * @var bool
     *
     * @ORM\Column(name="borrado", type="boolean", nullable=false, options={"comment"="0: activo - 1: borrado"})
     */
    private $borrado = '0';

    /**
     * @var \ProfesionalRegistracion
     *
     * @ORM\ManyToOne(targetEntity="ProfesionalRegistracion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="profesional_registracion_id", referencedColumnName="id")
     * })
     */
    private $profesionalRegistracion;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFechaCarga(): ?\DateTimeInterface
    {
        return $this->fechaCarga;
    }

    public function setFechaCarga(\DateTimeInterface $fechaCarga): self
    {
        $this->fechaCarga = $fechaCarga;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function getNombreArchivo(): ?string
    {
        return $this->nombreArchivo;
    }

    public function setNombreArchivo(string $nombreArchivo): self
    {
        $this->nombreArchivo = $nombreArchivo;

        return $this;
    }

    public function getTipoArchivo(): ?string
    {
        return $this->tipoArchivo;
    }

    public function setTipoArchivo(string $tipoArchivo): self
    {
        $this->tipoArchivo = $tipoArchivo;

        return $this;
    }

    public function isBorrado(): ?bool
    {
        return $this->borrado;
    }

    public function setBorrado(bool $borrado): self
    {
        $this->borrado = $borrado;

        return $this;
    }

    public function getProfesionalRegistracion(): ?ProfesionalRegistracion
    {
        return $this->profesionalRegistracion;
    }

    public function setProfesionalRegistracion(?ProfesionalRegistracion $profesionalRegistracion): self
    {
        $this->profesionalRegistracion = $profesionalRegistracion;

        return $this;
    }


}
