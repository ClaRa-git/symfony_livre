<?php

namespace App\Repository;

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
            ->join('s.authors', 'a')
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
            ->join('s.authors', 'a')
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
            's.imagePath',
            'a.firstname',
            'a.name'
        ])
            ->from(Serie::class, 's')
            ->join('s.authors', 'a')
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
            's.imagePath',
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
            's.imagePath',
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
            SELECT s.id, s.title, s.dateStarted, s.imagePath
            FROM App\Entity\Serie s
            ORDER BY s.' . $filter
        );

        return $query->getResult();
    }

    /**
     * Méthode pour récupérer toutes les informations sur les séries
     * @return array
     */
    public function getAllInfos(): array
    {
        $entityManager = $this->getEntityManager();

        $qb = $entityManager->createQueryBuilder();

        $query = $qb->select([
                's.id',
                's.title',
                's.imagePath',
                's.dateStarted',
                's.description',
                's.number_volume',
                's.isFinished',
                'a.id as authorId',
                'a.firstname',
                'a.name as authorName',
                'e.id as editorId',
                'e.name as editorName',
                't.id as typeId',
                't.label as typeLabel'
            ])
            ->from(Serie::class, 's')
            ->join('s.authors', 'a')
            ->join('s.editors', 'e')
            ->join('s.types', 't')
            ->getQuery();

        $results = $query->getResult();

        // Regrouper les éditeurs et genres
        $groupedResults = [];
        foreach ($results as $result) {
            $id = $result['id'];
            if (!isset($groupedResults[$id])) {
                $groupedResults[$id] = [
                    'id' => $result['id'],
                    'title' => $result['title'],
                    'imagePath' => $result['imagePath'],
                    'dateStarted' => $result['dateStarted'],
                    'description' => $result['description'],
                    'number_volume' => $result['number_volume'],
                    'isFinished' => $result['isFinished'],
                    'authors' => [],
                    'editors' => [],
                    'types' => [],
                ];
            }

             // Ajouter les auteurs (éviter les doublons si nécessaire)
            $authorId = $result['authorId'];
            if (!isset($groupedResults[$id]['authors'][$authorId])) {
                $groupedResults[$id]['authors'][$authorId] = [
                    'firstname' => $result['firstname'],
                    'name' => $result['authorName']
                ];
            }

            // Ajouter les éditeurs
            $editorId = $result['editorId'];
            if (!isset($groupedResults[$id]['editors'][$editorId])) {
                $groupedResults[$id]['editors'][$editorId] = [
                    'name' => $result['editorName']
                ];
            }

            // Ajouter les types
            $typeId = $result['typeId'];
            if (!isset($groupedResults[$id]['types'][$typeId])) {
                $groupedResults[$id]['types'][$typeId] = [
                    'label' => $result['typeLabel']
                ];
            }
        }

        // Convertir les collections associatives en simples tableaux indexés
        foreach ($groupedResults as &$serie) {
            $serie['authors'] = array_values($serie['authors']);
            $serie['editors'] = array_values($serie['editors']);
            $serie['types'] = array_values($serie['types']);
        }

        return array_values($groupedResults); // Retourner un tableau indexé
    }

    /**
     * Méthode pour créer une série
     * @param Serie $serie
     * @param bool $flush
     * @return void
     */
    public function save(Serie $serie, bool $flush = true): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($serie);

        if ($flush) {
            $entityManager->flush();
        }
    }
}
