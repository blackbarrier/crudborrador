<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PersonaContacto
 *
 * @ORM\Table(name="persona_contacto", indexes={@ORM\Index(name="FK_persona_contacto_persona", columns={"persona_id"})})
 * @ORM\Entity
 */
class PersonaContacto
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
     * @ORM\Column(name="telefono_fijo", type="string", length=50, nullable=false)
     */
    private $telefonoFijo;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono_movil", type="string", length=50, nullable=false)
     */
    private $telefonoMovil;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=100, nullable=false)
     */
    private $mail;

    /**
     * @var \Persona
     *
     * @ORM\ManyToOne(targetEntity="Persona")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="persona_id", referencedColumnName="id")
     * })
     */
    private $persona;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTelefonoFijo(): ?string
    {
        return $this->telefonoFijo;
    }

    public function setTelefonoFijo(string $telefonoFijo): self
    {
        $this->telefonoFijo = $telefonoFijo;

        return $this;
    }

    public function getTelefonoMovil(): ?string
    {
        return $this->telefonoMovil;
    }

    public function setTelefonoMovil(string $telefonoMovil): self
    {
        $this->telefonoMovil = $telefonoMovil;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

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


}
