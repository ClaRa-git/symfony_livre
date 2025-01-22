<?php

namespace App\Repository;

use App\Entity\Author;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Author>
 */
class AuthorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Author::class);
    }

    /**
     * Méthode pour récupérer les informations de/des auteur(s) d'une série
     * @param int $id
     * @return array
     */
    public function getAuthorsBySerie(int $id): array
    {
        $entityManager = $this->getEntityManager();

        $qb = $entityManager->createQueryBuilder();

        $query = $qb->select('a')
            ->from(Author::class, 'a')
            ->join('a.series', 's')
            ->where('s.id = :id')
            ->setParameter('id', $id)
            ->getQuery();
        
        return $query->getResult();
    }
}
