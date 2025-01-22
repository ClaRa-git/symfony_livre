<?php

namespace App\Repository;

use App\Entity\Type;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Type>
 */
class TypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Type::class);
    }

    /**
     * Méthode pour récupérer tous les types d'une série
     * @param $id
     * @return array
     */
    public function getTypesBySerie($id): array
    {
        $entityManager = $this->getEntityManager();

        $qb = $entityManager->createQueryBuilder();

        $query = $qb->select('t')
            ->from(Type::class, 't')
            ->join('t.serie', 's')
            ->where('s.id = :id')
            ->setParameter('id', $id)
            ->getQuery();

        return $query->getResult();
    }
}
