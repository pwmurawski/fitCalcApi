<?php

declare(strict_types=1);

namespace App\FoodProduct\Repository;

use Symfony\Component\Uid\Uuid;
use App\FoodProduct\Entity\FoodProduct;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<FoodProduct>
 *
 * @method FoodProduct|null find($id, $lockMode = null, $lockVersion = null)
 * @method FoodProduct|null findOneBy(array $criteria, array $orderBy = null)
 * @method FoodProduct[]    findAll()
 * @method FoodProduct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FoodProductRepository extends ServiceEntityRepository implements FoodProductRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FoodProduct::class);
    }

    public function save(FoodProduct $entity): void
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }

    public function remove(FoodProduct $entity): void
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
    }

    public function getByName(string $name): ?FoodProduct
    {
        return $this->findOneBy(['name' => $name]);
    }

    public function getById(Uuid $id): ?FoodProduct
    {
        return $this->find($id);
    }

    public function getAll(): array
    {
        return $this->findAll();
    }

    public function getByFoodProductIdUserId(Uuid $id, Uuid $userId): ?FoodProduct
    {
        return $this->findOneBy(['id' => $id, 'userId' => $userId]);
    }
}
