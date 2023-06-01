<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Profesional
 *
 * @ORM\Table(name="profesional", indexes={@ORM\Index(name="FK_profesional_distrito", columns={"distrito_id"}), @ORM\Index(name="FK_profesional_persona", columns={"persona_id"}), @ORM\Index(name="FK_profesional_profesion", columns={"tipo_matricula_id"}), @ORM\Index(name="FK_profesional_usuario", columns={"usuario_id"})})
 * @ORM\Entity
 */
class Profesional
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
     * @var int
     *
     * @ORM\Column(name="matricula", type="integer", nullable=false)
     */
    private $matricula;

    /**
     * @var string
     *
     * @ORM\Column(name="fallecido", type="string", length=2, nullable=false, options={"default"="NO","fixed"=true,"comment"="No - Si"})
     */
    private $fallecido = 'NO';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fecha_fallecido", type="date", nullable=true)
     */
    private $fechaFallecido;

    /**
     * @var bool
     *
     * @ORM\Column(name="habilitado", type="boolean", nullable=false, options={"comment"="1: habilitado - 0: no habilitado"})
     */
    private $habilitado = '0';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fecha_alta", type="date", nullable=true)
     */
    private $fechaAlta;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fecha_baja", type="date", nullable=true)
     */
    private $fechaBaja;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fecha_carga", type="datetime", nullable=true)
     */
    private $fechaCarga;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="borrado", type="boolean", nullable=true, options={"comment"="0: activo - 1: borrado"})
     */
    private $borrado = '0';

    /**
     * @var \Usuario
     *
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     * })
     */
    private $usuario;

    /**
     * @var \TipoMatricula
     *
     * @ORM\ManyToOne(targetEntity="TipoMatricula")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipo_matricula_id", referencedColumnName="id")
     * })
     */
    private $tipoMatricula;

    /**
     * @var \Persona
     *
     * @ORM\ManyToOne(targetEntity="Persona")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="persona_id", referencedColumnName="id")
     * })
     */
    private $persona;

    /**
     * @var \Distrito
     *
     * @ORM\ManyToOne(targetEntity="Distrito")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="distrito_id", referencedColumnName="id")
     * })
     */
    private $distrito;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatricula(): ?int
    {
        return $this->matricula;
    }

    public function setMatricula(int $matricula): self
    {
        $this->matricula = $matricula;

        return $this;
    }

    public function getFallecido(): ?string
    {
        return $this->fallecido;
    }

    public function setFallecido(string $fallecido): self
    {
        $this->fallecido = $fallecido;

        return $this;
    }

    public function getFechaFallecido(): ?\DateTimeInterface
    {
        return $this->fechaFallecido;
    }

    public function setFechaFallecido(?\DateTimeInterface $fechaFallecido): self
    {
        $this->fechaFallecido = $fechaFallecido;

        return $this;
    }

    public function isHabilitado(): ?bool
    {
        return $this->habilitado;
    }

    public function setHabilitado(bool $habilitado): self
    {
        $this->habilitado = $habilitado;

        return $this;
    }

    public function getFechaAlta(): ?\DateTimeInterface
    {
        return $this->fechaAlta;
    }

    public function setFechaAlta(?\DateTimeInterface $fechaAlta): self
    {
        $this->fechaAlta = $fechaAlta;

        return $this;
    }

    public function getFechaBaja(): ?\DateTimeInterface
    {
        return $this->fechaBaja;
    }

    public function setFechaBaja(?\DateTimeInterface $fechaBaja): self
    {
        $this->fechaBaja = $fechaBaja;

        return $this;
    }

    public function getFechaCarga(): ?\DateTimeInterface
    {
        return $this->fechaCarga;
    }

    public function setFechaCarga(?\DateTimeInterface $fechaCarga): self
    {
        $this->fechaCarga = $fechaCarga;

        return $this;
    }

    public function isBorrado(): ?bool
    {
        return $this->borrado;
    }

    public function setBorrado(?bool $borrado): self
    {
        $this->borrado = $borrado;

        return $this;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(?Usuario $usuario): self
    {
        $this->usuario = $usuario;

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

    public function getPersona(): ?Persona
    {
        return $this->persona;
    }

    public function setPersona(?Persona $persona): self
    {
        $this->persona = $persona;

        return $this;
    }

    public function getDistrito(): ?Distrito
    {
        return $this->distrito;
    }

    public function setDistrito(?Distrito $distrito): self
    {
        $this->distrito = $distrito;

        return $this;
    }


}
