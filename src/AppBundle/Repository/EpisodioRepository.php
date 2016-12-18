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

    public function desmarcarTodosDaTemporada(int $temporadaId): void
    {
        $sql = 'UPDATE AppBundle:Episodio e SET e.assistido = 0 WHERE e.temporadaId = :temporadaId';

        $this->getEntityManager()->createQuery($sql)
            ->setParameter(':temporadaId', $temporadaId)
            ->execute();
    }
}
