<?php
/**
 * @author Denys Salamatov <denysaw@gmail.com>
 */
declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EmployeeRepository")
 * @ORM\Table(name="employee")
 * @ORM\HasLifecycleCallbacks
 */
class Employee extends BaseEntity
{

	/**
	 * @var string
	 *
	 * @ORM\Column(type="string")
	 * @Assert\NotBlank()
	 * @Assert\Length(min=2, max=40)
	 */
	protected $name;

	/**
	 * @var int
	 *
	 * @ORM\Column(type="smallint", options={"unsigned": true})
	 * @Assert\GreaterThan(18)
	 * @Assert\LessThan(150)
	 */
	protected $age;

	/**
	 * @var int
	 *
	 * @ORM\Column(type="smallint", nullable=true, options={"unsigned": true, "default": 0})
	 */
	protected $kids;

	/**
	 * @ORM\ManyToMany(targetEntity="Car", inversedBy="drivers")
	 * @ORM\JoinTable(name="employees_cars")
	 */
	private $cars;

	/**
	 * @var int
	 *
	 * @ORM\Column(type="integer", options={"unsigned": true, "default": 0})
	 */
	protected $salary;

	/**
	 * @ORM\OneToMany(targetEntity="Payout", mappedBy="employee")
	 */
	private $payouts;


	public function __construct()
	{
		$this->cars = new ArrayCollection();
	}

	/**
	 * @return string
	 */
	public function getName(): string
	{
		return $this->name;
	}

	/**
	 * @param string $name
	 */
	public function setName(string $name): void
	{
		$this->name = $name;
	}

	/**
	 * @return int
	 */
	public function getAge(): int
	{
		return $this->age;
	}

	/**
	 * @param int $age
	 */
	public function setAge(int $age): void
	{
		$this->age = $age;
	}

	/**
	 * @return int
	 */
	public function getKids(): int
	{
		return $this->kids;
	}

	/**
	 * @param int $kids
	 */
	public function setKids(int $kids): void
	{
		$this->kids = $kids;
	}

	/**
	 * @return bool
	 */
	public function hasCar(): bool
	{
		return !!$this->cars;
	}

	/**
	 * @return mixed
	 */
	public function getCars()
	{
		return $this->cars;
	}

	/**
	 * @param Car $car
	 */
	public function addCar(Car $car): void
	{
		$car->addDriver($this);
		$this->cars[] = $car;
	}

	/**
	 * @param Car $car
	 */
	public function removeCar(Car $car): void
	{
		$car->removeDriver($this);
		$this->cars->removeElement($car);
	}

	/**
	 * @return int
	 */
	public function getSalary(): int
	{
		return $this->salary;
	}

	/**
	 * @param int $salary
	 */
	public function setSalary(int $salary): void
	{
		$this->salary = $salary;
	}

	/**
	 * @return mixed
	 */
	public function getPayouts()
	{
		return $this->payouts;
	}
}