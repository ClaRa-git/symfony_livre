<?php

namespace App\Repository;

use App\Entity\Book;
use App\Entity\Serie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Serie>
 */
class SerieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Serie::class);
    }
    
    /**
     * Méthode pour récupérer la couverture du premier livre d'une série
     * @param int $id
     * @return string
     */
    public function getFistBookCover(int $id): string
    {
        $entityManager = $this->getEntityManager();

        $qb = $entityManager->createQueryBuilder();

        $query = $qb->select('b.imagePath')
            ->from(Book::class, 'b')
            ->where('b.serie = :id')
            ->setParameter('id', $id)
            ->setMaxResults(1)
            ->getQuery();

        return $query->getResult()[0]['imagePath'];
    }

    /**
     * Méthode pour récupérer un auteur et un éditeur pour une série
     * @param int $id
     * @return array
     */
    public function getAuthorForSerie(int $id): array
    {
        $entityManager = $this->getEntityManager();

        $qb = $entityManager->createQueryBuilder();

        $query = $qb->select([
            'a.firstname',
            'a.name'
        ])
            ->from(Serie::class, 's')
            ->join('s.author', 'a')
            ->where('s.id = :id')
            ->setParameter('id', $id)
            ->getQuery();

        return $query->getResult();
    }

    /**
     * Méthode pour récupérer un auteur et un éditeur pour une série
     * @param int $id
     * @return array
     */
    public function getEditorForSerie(int $id): array
    {
        $entityManager = $this->getEntityManager();

        $qb = $entityManager->createQueryBuilder();

        $query = $qb->select([
            'e.name as editor'
        ])
            ->from(Serie::class, 's')
            ->join('s.editors', 'e')
            ->where('s.id = :id')
            ->setParameter('id', $id)
            ->getQuery();

        return $query->getResult();
    }

    /**
     * Méthode pour récupérer les genres d'une série
     * @param int $id
     * @return array
     */
    public function getTypesForSerie(int $id): array
    {
        $entityManager = $this->getEntityManager();

        $qb = $entityManager->createQueryBuilder();

        $query = $qb->select([
            'g.label as type'
        ])
            ->from(Serie::class, 's')
            ->join('s.types', 'g')
            ->where('s.id = :id')
            ->setParameter('id', $id)
            ->getQuery();

        return $query->getResult();
    }

    /**
     * Méthode qui retourne la liste des séries par auteur
     * @return array
     */
    public function getCountSeriesByAuthor(): array
    {
        $entityManager = $this->getEntityManager();

        $qb = $entityManager->createQueryBuilder();

        $query = $qb->select([
            'a.id',
            'a.firstname',
            'a.name',
            'COUNT(s.id) as total'
        ])
            ->from(Serie::class, 's')
            ->join('s.author', 'a')
            ->groupBy('a.id')
            ->getQuery();

        return $query->getResult();
    }

    /**
     * Méthode pour récupérer les séries par auteur
     * @param int $id
     * @return array
     */
    public function getSeriesByAuthor(int $id): array
    {
        $entityManager = $this->getEntityManager();

        $qb = $entityManager->createQueryBuilder();

        $query = $qb->select([
            's.id',
            's.title',
            'a.firstname',
            'a.name'
        ])
            ->from(Serie::class, 's')
            ->join('s.author', 'a')
            ->where('a.id = :id')
            ->setParameter('id', $id)
            ->getQuery();

        return $query->getResult();
    }

    /**
     * Méthode qui retourne la liste des séries par éditeur
     * @return array
     */
    public function getCountSeriesByEditor(): array
    {
        $entityManager = $this->getEntityManager();

        $qb = $entityManager->createQueryBuilder();

        $query = $qb->select([
            'e.id',
            'e.name',
            'COUNT(s.id) as total'
        ])
            ->from(Serie::class, 's')
            ->join('s.editors', 'e')
            ->groupBy('e.id')
            ->getQuery();

        return $query->getResult();
    }

    /**
     * Méthode pour récupérer les séries par editeur
     * @param int $id
     * @return array
     */
    public function getSeriesByEditor(int $id): array
    {
        $entityManager = $this->getEntityManager();

        $qb = $entityManager->createQueryBuilder();

        $query = $qb->select([
            's.id',
            's.title',
            'e.name'
        ])
            ->from(Serie::class, 's')
            ->join('s.editors', 'e')
            ->where('e.id = :id')
            ->setParameter('id', $id)
            ->getQuery();

        return $query->getResult();
    }

    /**
     * Méthode qui retourne la liste des séries par genres
     * @return array
     */
    public function getCountSeriesByType(): array
    {
        $entityManager = $this->getEntityManager();

        $qb = $entityManager->createQueryBuilder();

        $query = $qb->select([
            'g.id',
            'g.label',
            'COUNT(s.id) as total'
        ])
            ->from(Serie::class, 's')
            ->join('s.types', 'g')
            ->groupBy('g.id')
            ->getQuery();

        return $query->getResult();
    }

    /**
     * Méthode pour récupérer les séries par genres
     * @param int $id
     * @return array
     */
    public function getSeriesByType(int $id): array
    {
        $entityManager = $this->getEntityManager();

        $qb = $entityManager->createQueryBuilder();

        $query = $qb->select([
            's.id',
            's.title',
            'g.label'
        ])
            ->from(Serie::class, 's')
            ->join('s.types', 'g')
            ->where('g.id = :id')
            ->setParameter('id', $id)
            ->getQuery();

        return $query->getResult();
    }

    /**
     * Méthode qui retourne la liste des séries par filtre
     * @param string $filter
     * @return array
     */
    public function getSeriesByFilter(string $filter): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery('
            SELECT s.id, s.title, s.dateStarted
            FROM App\Entity\Serie s
            ORDER BY s.' . $filter
        );

        return $query->getResult();
    }
}
