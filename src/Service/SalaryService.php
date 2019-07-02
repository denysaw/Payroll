<?php
/**
 * @author Denys Salamatov <denysaw@gmail.com>
 */
declare(strict_types=1);

namespace App\Service;

use App\Entity\Employee;
use App\Entity\Payout;
use App\Entity\SalaryRule;
use App\Repository\EmployeeRepository;
use App\Repository\SalaryRuleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Class SalaryService
 * @package App\Service
 */
class SalaryService
{

	/**
	 * @var EntityManagerInterface
	 */
	protected $entityManager;

	/**
	 * @var SalaryRuleRepository
	 */
	protected $ruleRepository;

	/**
	 * @var EmployeeRepository
	 */
	protected $employeeRepository;

	/**
	 * @var SymfonyStyle
	 */
	protected $output;


	/**
	 * SalaryService constructor.
	 * @param EntityManagerInterface $entityManager
	 * @param SalaryRuleRepository $ruleRepository
	 * @param EmployeeRepository $employeeRepository
	 */
	public function __construct(EntityManagerInterface $entityManager, SalaryRuleRepository $ruleRepository, EmployeeRepository $employeeRepository)
	{
		$this->entityManager = $entityManager;
		$this->ruleRepository = $ruleRepository;
		$this->employeeRepository = $employeeRepository;
	}

	/**
	 * @param Employee $employee
	 * @param bool $flush
	 */
	public function pay(Employee $employee, $flush = true)
	{
		$payout = new Payout();
		$payout->setEmployee($employee);
		$payout->setAmount($this->calculate($employee));
		$this->entityManager->persist($payout);

		if ($flush) $this->entityManager->flush();
	}

	public function payAll()
	{
		foreach ($this->employeeRepository->findAll() as $employee) {
			$this->pay($employee, false);
		}

		$this->entityManager->flush();
	}

	/**
	 * @param Employee $employee
	 * @return int
	 */
	public function calculate(Employee $employee): int
	{
		$net = $gross = $employee->getSalary();

		if ($this->isVerbose()) {
			$this->output->newLine();
			$this->output->text($employee->getName(). ' has gross salary of $'. $employee->getSalary());
		}

		/** @var SalaryRule $rule */
		foreach ($this->ruleRepository->findAll() as $rule) {
			$qb = $this->employeeRepository->createQueryBuilder('e')
				->where('e.id = :id')
				->setParameter('id', $employee->getId());

			if ($rule->hasCondition()) {
				$qb->andWhere('e.'. $rule->getCondition());
			}

			if ($qb->getQuery()->getOneOrNullResult()) {
				$action   = $rule->getAction();
				$operator = substr($action, 0, 1);
				$is_pct   = substr($action, -1) == '%';
				$value    = (int) substr($action, 1, $is_pct ? -1 : strlen($action));
				$was      = $net;

				// Holding myself out of using eval() here :)
				if ($is_pct) {
					$value = $value / 100 * $gross;
				}

				if (in_array($operator, ['+', '-'])) {
					$net += ($operator == '+' ? 1 : -1) * $value;
				} elseif ($operator == '*') {
					$net *= $value;
				} elseif ($operator == '/') {
					$net /= $value;
				}

				if ($this->isVerbose()) {
					$diff = $net - $was;
					$way = $diff < 0 ? 'bonus' : 'deduction';
					$this->output->text($employee->getName(). ' got a '. $way. ' of $'. (int) abs($diff). ' due to "'. $rule->getName(). '"');
				}
			}
		}

		if ($this->isVerbose()) {
			$this->output->section($employee->getName(). ' was paid a net wage of $'. (int)$net);
		}

		return (int) $net;
	}

	/**
	 * @param SymfonyStyle $output
	 */
	public function setOutput(SymfonyStyle $output)
	{
		$this->output = $output;
	}

	/**
	 * @return bool
	 */
	public function isVerbose(): bool
	{
		return !!$this->output;
	}
}