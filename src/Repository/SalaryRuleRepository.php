<?php
/**
 * @author Denys Salamatov <denysaw@gmail.com>
 */
declare(strict_types=1);

namespace App\Repository;

use App\Entity\SalaryRule;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * Class SalaryRuleRepository
 * @package App\Repository
 */
class SalaryRuleRepository extends ServiceEntityRepository
{

	/**
	 * EmployeeRepository constructor.
	 * @param ManagerRegistry $registry
	 */
	public function __construct(ManagerRegistry $registry)
	{
		parent::__construct($registry, SalaryRule::class);
	}
}