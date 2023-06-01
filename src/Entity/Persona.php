<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Persona
 *
 * @ORM\Table(name="persona", indexes={@ORM\Index(name="FK_persona_pais", columns={"pais_id"}), @ORM\Index(name="FK_persona_sexo", columns={"sexo_id"}), @ORM\Index(name="FK_persona_tipodocumento", columns={"tipo_documento_id"})})
 * @ORM\Entity
 */
class Persona
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
     * @var string
     *
     * @ORM\Column(name="apellido", type="string", length=100, nullable=false)
     */
    private $apellido;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_nacimiento", type="date", nullable=false)
     */
    private $fechaNacimiento;

    /**
     * @var int
     *
     * @ORM\Column(name="numero_documento", type="integer", nullable=false)
     */
    private $numeroDocumento;

    /**
     * @var string|null
     *
     * @ORM\Column(name="cuil", type="string", length=50, nullable=true)
     */
    private $cuil;

    /**
     * @var \TipoDocumento
     *
     * @ORM\ManyToOne(targetEntity="TipoDocumento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipo_documento_id", referencedColumnName="id")
     * })
     */
    private $tipoDocumento;

    /**
     * @var \Sexo
     *
     * @ORM\ManyToOne(targetEntity="Sexo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sexo_id", referencedColumnName="id")
     * })
     */
    private $sexo;

    /**
     * @var \Pais
     *
     * @ORM\ManyToOne(targetEntity="Pais")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pais_id", referencedColumnName="id")
     * })
     */
    private $pais;

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

    public function getApellido(): ?string
    {
        return $this->apellido;
    }

    public function setApellido(string $apellido): self
    {
        $this->apellido = $apellido;

        return $this;
    }

    public function getFechaNacimiento(): ?\DateTimeInterface
    {
        return $this->fechaNacimiento;
    }

    public function setFechaNacimiento(\DateTimeInterface $fechaNacimiento): self
    {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    public function getNumeroDocumento(): ?int
    {
        return $this->numeroDocumento;
    }

    public function setNumeroDocumento(int $numeroDocumento): self
    {
        $this->numeroDocumento = $numeroDocumento;

        return $this;
    }

    public function getCuil(): ?string
    {
        return $this->cuil;
    }

    public function setCuil(?string $cuil): self
    {
        $this->cuil = $cuil;

        return $this;
    }

    public function getTipoDocumento(): ?TipoDocumento
    {
        return $this->tipoDocumento;
    }

    public function setTipoDocumento(?TipoDocumento $tipoDocumento): self
    {
        $this->tipoDocumento = $tipoDocumento;

        return $this;
    }

    public function getSexo(): ?Sexo
    {
        return $this->sexo;
    }

    public function setSexo(?Sexo $sexo): self
    {
        $this->sexo = $sexo;

        return $this;
    }

    public function getPais(): ?Pais
    {
        return $this->pais;
    }

    public function setPais(?Pais $pais): self
    {
        $this->pais = $pais;

        return $this;
    }


}
