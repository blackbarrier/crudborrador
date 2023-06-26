<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PersonaDomicilio
 *
 * @ORM\Table(name="persona_domicilio", indexes={@ORM\Index(name="FK_persona_domicilio_localidad", columns={"localidad_id"}), @ORM\Index(name="FK_persona_domicilio_persona", columns={"persona_id"})})
 * @ORM\Entity
 */
class PersonaDomicilio
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
     * @ORM\Column(name="calle", type="string", length=100, nullable=false)
     */
    private $calle;

    /**
     * @var string
     *
     * @ORM\Column(name="numero", type="string", length=10, nullable=true)
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="piso", type="string", length=10, nullable=true)
     */
    private $piso;

    /**
     * @var string
     *
     * @ORM\Column(name="departamento", type="string", length=10, nullable=true)
     */
    private $departamento;

    /**
     * @var bool
     *
     * @ORM\Column(name="borradoEstado", type="boolean", nullable=false, options={"comment"="0: activo - 1: borrado"})
     */
    private $borradoestado = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_actualizacion", type="datetime", nullable=false)
     */
    private $fechaActualizacion;

    // /**
    //  * @var int
    //  *
    //  * @ORM\Column(name="usuario_actualiza_id", type="integer", nullable=false)
    //  */
    // private $usuarioActualizaId;

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
     * @var \Localidad
     *
     * @ORM\ManyToOne(targetEntity="Localidad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="localidad_id", referencedColumnName="id")
     * })
     */
    private $localidad;

    /**
     * @ORM\ManyToOne(targetEntity=Usuario::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $usuarioActualizaId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCalle(): ?string
    {
        return $this->calle;
    }

    public function setCalle(string $calle): self
    {
        $this->calle = $calle;

        return $this;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getPiso(): ?string
    {
        return $this->piso;
    }

    public function setPiso(string $piso): self
    {
        $this->piso = $piso;

        return $this;
    }

    public function getDepartamento(): ?string
    {
        return $this->departamento;
    }

    public function setDepartamento(string $departamento): self
    {
        $this->departamento = $departamento;

        return $this;
    }

    public function isBorradoestado(): ?bool
    {
        return $this->borradoestado;
    }

    public function setBorradoestado(bool $borradoestado): self
    {
        $this->borradoestado = $borradoestado;

        return $this;
    }

    public function getFechaActualizacion(): ?\DateTimeInterface
    {
        return $this->fechaActualizacion;
    }

    public function setFechaActualizacion(\DateTimeInterface $fechaActualizacion): self
    {
        $this->fechaActualizacion = $fechaActualizacion;

        return $this;
    }

    // public function getUsuarioActualizaId(): ?int
    // {
    //     return $this->usuarioActualizaId;
    // }

    // public function setUsuarioActualizaId(int $usuarioActualizaId): self
    // {
    //     $this->usuarioActualizaId = $usuarioActualizaId;

    //     return $this;
    // }

    public function getPersona(): ?Persona
    {
        return $this->persona;
    }

    public function setPersona(?Persona $persona): self
    {
        $this->persona = $persona;

        return $this;
    }

    public function getLocalidad(): ?Localidad
    {
        return $this->localidad;
    }

    public function setLocalidad(?Localidad $localidad): self
    {
        $this->localidad = $localidad;

        return $this;
    }

    public function getUsuarioActualizaId(): ?Usuario
    {
        return $this->usuarioActualizaId;
    }

    public function setUsuarioActualizaId(?Usuario $usuarioActualizaId): self
    {
        $this->usuarioActualizaId = $usuarioActualizaId;

        return $this;
    }


}
