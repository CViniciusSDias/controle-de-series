<?php
namespace AppBundle\Entity;

use Symfony\Component\PropertyAccess\Exception\NoSuchPropertyException;

trait ModelTrait
{
    public function __get($propriedade)
    {
        $metodo = 'get' . ucfirst($propriedade);
        if (method_exists($this, $metodo))
            return $this->$metodo();

        if (property_exists($this, $propriedade))
            return $this->$propriedade;

        throw new NoSuchPropertyException('Propriedade inexistente');
    }

    public function __set($propriedade, $valor): void
    {
        $metodo = 'set' . ucfirst($propriedade);
        if (method_exists($this, $propriedade)) {
            $this->$metodo($valor);
            return;
        }

        if (property_exists($this, $propriedade)) {
            $this->$propriedade = $valor;
            return;
        }

        throw new NoSuchPropertyException('Propriedade inexistente');
    }

    public function __call($metodo, $args)
    {
        $propriedade = lcfirst(str_replace('get', '', $metodo));

        if (property_exists($this, $propriedade))
            return $this->$propriedade;

        throw new NoSuchPropertyException('Propriedade inexistente');
    }
}