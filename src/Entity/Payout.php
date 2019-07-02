<?php
/**
 * @author Denys Salamatov <denysaw@gmail.com>
 */
declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="payout")
 * @ORM\HasLifecycleCallbacks
 */
class Payout extends BaseEntity
{

	/**
	 * @var Employee
	 *
	 * @ORM\ManyToOne(targetEntity="Employee", inversedBy="payouts")
	 */
	private $employee;

	/**
	 * @var int
	 *
	 * @ORM\Column(type="integer", options={"unsigned": true, "default": 0})
	 */
	protected $amount;


	/**
	 * @return Employee
	 */
	public function getEmployee(): Employee
	{
		return $this->employee;
	}

	/**
	 * @param Employee $employee
	 */
	public function setEmployee(Employee $employee)
	{
		$this->employee = $employee;
	}

	/**
	 * @return int
	 */
	public function getAmount(): int
	{
		return $this->amount;
	}

	/**
	 * @param int $amount
	 */
	public function setAmount(int $amount)
	{
		$this->amount = $amount;
	}
}