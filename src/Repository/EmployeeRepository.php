<?php
/**
 * @author Denys Salamatov <denysaw@gmail.com>
 */
declare(strict_types=1);

namespace App\Repository;

use App\Entity\Employee;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * Class EmployeeRepository
 * @package App\Repository
 */
class EmployeeRepository extends ServiceEntityRepository
{

	/**
	 * EmployeeRepository constructor.
	 * @param ManagerRegistry $registry
	 */
	public function __construct(ManagerRegistry $registry)
	{
		parent::__construct($registry, Employee::class);
	}
}