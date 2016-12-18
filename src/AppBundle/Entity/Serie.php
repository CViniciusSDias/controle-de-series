<?php
namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="serie")
 */
class Serie
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nome;

    /**
     * @ORM\OneToMany(targetEntity="Temporada", mappedBy="serie", cascade={"persist"})
     */
    private $temporadas;

    use ModelTrait;

    public function __construct()
    {
        $this->temporadas = new ArrayCollection();
    }

    public function preencheTemporadas(int $numeroDeTemporadas, int $numeroDeEpisodios)
    {
        for ($i = 1; $i <= $numeroDeTemporadas; $i++) {
            $temporada = new Temporada();
            $temporada->numero = $i;
            $temporada->serie = $this;
            $temporada->preencheEpisodios($numeroDeEpisodios);
            $this->temporadas->add($temporada);
        }
    }
}