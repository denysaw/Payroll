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
 * @ORM\Entity(repositoryClass="App\Repository\CarRepository")
 * @ORM\Table(name="car")
 * @ORM\HasLifecycleCallbacks
 */
class Car extends BaseEntity
{

	/**
	 * @var string
	 *
	 * @ORM\Column(type="string")
	 * @Assert\NotBlank()
	 * @Assert\Length(min=3, max=50)
	 */
	protected $model;

	/**
	 * @var string
	 *
	 * @ORM\Column(type="string")
	 * @Assert\NotBlank()
	 * @Assert\Length(min=3, max=15)
	 */
	protected $color;

	/**
	 * @var string
	 *
	 * @ORM\Column(type="string")
	 * @Assert\NotBlank()
	 * @Assert\Length(min=3, max=20)
	 */
	protected $type;

	/**
	 * @var string
	 *
	 * @ORM\Column(type="string")
	 * @Assert\NotBlank()
	 * @Assert\Length(min=3, max=10)
	 */
	protected $fuel;

	/**
	 * @var int
	 *
	 * @ORM\Column(type="integer", options={"unsigned": true})
	 */
	protected $power;

	/**
	 * @var Employee[]
	 *
	 * @ORM\ManyToMany(targetEntity="Employee", mappedBy="cars")
	 */
	private $drivers;


	public function __construct()
	{
		$this->drivers = new ArrayCollection();
	}

	/**
	 * @return string
	 */
	public function getModel(): string
	{
		return $this->model;
	}

	/**
	 * @param string $model
	 */
	public function setModel(string $model): void
	{
		$this->model = $model;
	}

	/**
	 * @return string
	 */
	public function getColor(): string
	{
		return $this->color;
	}

	/**
	 * @param string $color
	 */
	public function setColor(string $color): void
	{
		$this->color = $color;
	}

	/**
	 * @return string
	 */
	public function getType(): string
	{
		return $this->type;
	}

	/**
	 * @param string $type
	 */
	public function setType(string $type): void
	{
		$this->type = $type;
	}

	/**
	 * @return string
	 */
	public function getFuel(): string
	{
		return $this->fuel;
	}

	/**
	 * @param string $fuel
	 */
	public function setFuel(string $fuel): void
	{
		$this->fuel = $fuel;
	}

	/**
	 * @return int
	 */
	public function getPower(): int
	{
		return $this->power;
	}

	/**
	 * @param int $power
	 */
	public function setPower(int $power): void
	{
		$this->power = $power;
	}

	/**
	 * @return bool
	 */
	public function hasDrivers(): bool
	{
		return !!$this->drivers;
	}

	/**
	 * @return Employee[]
	 */
	public function getDrivers(): array
	{
		return $this->drivers;
	}

	/**
	 * @param Employee $driver
	 */
	public function addDriver(Employee $driver): void
	{
		$this->drivers[] = $driver;
	}

	/**
	 * @param Employee $driver
	 */
	public function removeDriver(Employee $driver): void
	{
		$this->drivers->removeElement($driver);
	}
}