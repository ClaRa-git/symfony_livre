<?php

namespace App\Repository;

use App\Entity\Editor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Editor>
 */
class EditorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Editor::class);
    }

    /**
     * Méthode pour récupérer tous les éditeurs d'une série
     * @param $id
     * @return array
     */
    public function getEditorsBySerie($id): array
    {
        $entityManager = $this->getEntityManager();

        $qb = $entityManager->createQueryBuilder();

        $query = $qb->select('e')
            ->from(Editor::class, 'e')
            ->join('e.serie', 's')
            ->where('s.id = :id')
            ->setParameter('id', $id)
            ->getQuery();

        return $query->getResult();
    }
}
