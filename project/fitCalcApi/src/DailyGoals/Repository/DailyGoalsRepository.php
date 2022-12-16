<?php

declare(strict_types=1);

namespace App\DailyGoals\Repository;

use Symfony\Component\Uid\Uuid;
use App\DailyGoals\Entity\DailyGoals;
use DateTimeInterface;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<DailyGoals>
 *
 * @method DailyGoals|null find($id, $lockMode = null, $lockVersion = null)
 * @method DailyGoals|null findOneBy(array $criteria, array $orderBy = null)
 * @method DailyGoals[]    findAll()
 * @method DailyGoals[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DailyGoalsRepository extends ServiceEntityRepository implements DailyGoalsRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DailyGoals::class);
    }

    public function save(DailyGoals $entity): void
    {
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
    }

    public function remove(DailyGoals $entity): void
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();
    }

    public function getByName(string $name): ?DailyGoals
    {
        return $this->findOneBy(['name' => $name]);
    }

    public function getById(Uuid $id): ?DailyGoals
    {
        return $this->find($id);
    }

    public function getAll(): array
    {
        return $this->findAll();
    }

    public function getByDailyGoalsIdUserId(Uuid $id, Uuid $userId): ?DailyGoals
    {
        return $this->findOneBy(['id' => $id, 'userId' => $userId]);
    }

    public function getByDateUserId(DateTimeInterface $date, Uuid $userId)
    {
        $date = $date->modify('+1 day');
        $data = $this->createQueryBuilder('dailyGoals')
            ->orderBy('dailyGoals.date', 'DESC')
            ->andWhere('dailyGoals.userId = :user')->setParameter('user', $userId)
            ->andWhere('dailyGoals.date < :date')->setParameter('date', $date)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
        return $data ?? $this->findOneBy([], ['date' => 'ASC']);
    }
}
