<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class EpisodioRepository extends EntityRepository
{
    public function marcarAssitidoPorId(int $episodioId, bool $assistido): void
    {
        $sql = 'UPDATE AppBundle:Episodio e SET e.assistido = :assistido WHERE e.id = :id';

        $this->getEntityManager()->createQuery($sql)
            ->setParameter(':assistido', $assistido)
            ->setParameter(':id', $episodioId)
            ->execute();
    }

    public function marcarTodosDaTemporada(int $temporadaId, bool $assistido = false): void
    {
        $sql = 'UPDATE AppBundle:Episodio e SET e.assistido = :assistido WHERE e.temporadaId = :temporadaId';

        $this->getEntityManager()->createQuery($sql)
            ->setParameter(':assistido', $assistido)
            ->setParameter(':temporadaId', $temporadaId)
            ->execute();
    }
}
