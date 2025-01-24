<?php

namespace App\Repository;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Editor;
use App\Entity\Serie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Book>
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    /**
     * Méthode pour récupérer tous les livres d'une série
     * @param int $id
     * @return array
     */
    public function findAllForSerie(int $id)
    {
        $entityManager = $this->getEntityManager();

        $qb = $entityManager->createQueryBuilder();

        $query = $qb->select([
            'b.id',
            'b.title',
            'b.description',
            'b.imagePath'
        ])
            ->from(Book::class, 'b')
            ->where('b.serie = :id')
            ->setParameter('id', $id)
            ->getQuery();

        return $query->getResult();
    }

    /**
     * Méthode pour récupérer un livre et une série à partir d'un id d'un livre
     * @param int $id
     * @return array
     */
    public function getSerieByBook(int $id): array
    {
        $entityManager = $this->getEntityManager();

        $qb = $entityManager->createQueryBuilder();

        $query = $qb->select([
            'b',
            's'
        ])
            ->from(Book::class, 'b')
            ->join('b.serie', 's')
            ->where('b.id = :id')
            ->setParameter('id', $id)
            ->getQuery();

        return $query->getResult();
    }

    /**
     * Méthode pour créer un livre
     * @param Book $book
     * @param bool $flush
     * @return void
     */
    public function save(Book $book, bool $flush = true): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($book);

        if ($flush) {
            $entityManager->flush();
        }
    }
}
