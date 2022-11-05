<?php

declare(strict_types=1);

namespace App\SelectedProduct\Repository;

use DateTimeInterface;
use Symfony\Component\Uid\Uuid;
use Doctrine\Persistence\ManagerRegistry;
use App\SelectedProduct\Entity\SelectedProduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<SelectedProduct>
 *
 * @method SelectedProduct|null find($id, $lockMode = null, $lockVersion = null)
 * @method SelectedProduct|null findOneBy(array $criteria, array $orderBy = null)
 * @method SelectedProduct[]    findAll()
 * @method SelectedProduct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SelectedProductRepository extends ServiceEntityRepository implements SelectedProductRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SelectedProduct::class);
    }

    public function save(SelectedProduct $entity): void
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }

    public function remove(SelectedProduct $entity): void
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
    }

    public function getById(Uuid $id): ?SelectedProduct
    {
        return $this->find($id);
    }

    public function getByDateUserId(DateTimeInterface $date, Uuid $userId): array
    {
        return $this->findBy(['dateTime' => $date, 'userId' => $userId]);
    }

    public function getByIdUserId(Uuid $id, Uuid $userId): ?SelectedProduct
    {
        return $this->findOneBy(['id' => $id, 'userId' => $userId]);
    }
}
