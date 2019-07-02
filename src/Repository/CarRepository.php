<?php
/**
 * @author Denys Salamatov <denysaw@gmail.com>
 */
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Car;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * Class CarRepository
 * @package App\Repository
 */
class CarRepository extends ServiceEntityRepository
{

	/**
	 * CarRepository constructor.
	 * @param ManagerRegistry $registry
	 */
	public function __construct(ManagerRegistry $registry)
	{
		parent::__construct($registry, Car::class);
	}

	/**
	 * @return Car|null
	 */
	public function getOneRandom(): ?Car
	{
		return $this->createQueryBuilder('c')
			->orderBy('RAND()')
			->setMaxResults(1)
			->getQuery()
			->getOneOrNullResult();
	}
}