<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Comanda
 *
 * @ORM\Table(name="comanda")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ComandaRepository")
 */
class Comanda
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="mesa", type="smallint")
     */
    private $mesa;

    /**
     * @var string
     *
     * @ORM\Column(name="comanda", type="string", length=1000)
     * @Assert\Length(
     *      min = 5,
     *      max = 10000,
     *      minMessage = "Manda pedir más, al menos hasta que ocupe {{ limit }} caracteres",
     *      maxMessage = "No puedo guardar más de {{ limit }} caracteres"
     * )
     */
    private $comanda;

    /**
     * @var string
     *
     * @ORM\Column(name="importe", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $importe;

    /**
     * @var bool
     *
     * @ORM\Column(name="pagado", type="boolean", nullable=true)
     */
    private $pagado;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set mesa
     *
     * @param integer $mesa
     *
     * @return Comanda
     */
    public function setMesa($mesa)
    {
        $this->mesa = $mesa;

        return $this;
    }

    /**
     * Get mesa
     *
     * @return int
     */
    public function getMesa()
    {
        return $this->mesa;
    }

    /**
     * Set comanda
     *
     * @param string $comanda
     *
     * @return Comanda
     */
    public function setComanda($comanda)
    {
        $this->comanda = $comanda;

        return $this;
    }

    /**
     * Get comanda
     *
     * @return string
     */
    public function getComanda()
    {
        return $this->comanda;
    }

    /**
     * Set importe
     *
     * @param string $importe
     *
     * @return Comanda
     */
    public function setImporte($importe)
    {
        $this->importe = $importe;

        return $this;
    }

    /**
     * Get importe
     *
     * @return string
     */
    public function getImporte()
    {
        return $this->importe;
    }

    /**
     * Set pagado
     *
     * @param boolean $pagado
     *
     * @return Comanda
     */
    public function setPagado($pagado)
    {
        $this->pagado = $pagado;

        return $this;
    }

    /**
     * Get pagado
     *
     * @return bool
     */
    public function getPagado()
    {
        return $this->pagado;
    }
}

