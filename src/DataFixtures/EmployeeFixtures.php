<?php
/**
 * @author Denys Salamatov <denysaw@gmail.com>
 */
declare(strict_types=1);

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Car;
use App\Entity\Employee;
use App\Repository\CarRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class EmployeeFixtures
 * @package App\DataFixtures
 */
class EmployeeFixtures extends Fixture
{

	/**
	 * @var CarRepository
	 */
	private $carRepository;


	/**
	 * EmployeeFixtures constructor.
	 * @param CarRepository $carRepository
	 */
	public function __construct(CarRepository $carRepository)
	{
		$this->carRepository = $carRepository;
	}

	/**
	 * @param ObjectManager $om
	 */
	public function load(ObjectManager $om)
    {
	    $faker = Factory::create();
	    $count = 50;

	    while ($count--) {
		    $employee = new Employee();
		    $employee->setName($faker->name);
		    $employee->setAge($faker->numberBetween(18, 90));
		    $employee->setKids($faker->numberBetween(0, 4));
		    $employee->setSalary($faker->numberBetween(2, 9) * 1000);

		    if (rand(0, 1)) {
				$employee->addCar($this->carRepository->getOneRandom());
		    }

		    $om->persist($employee);
	    }

	    $om->flush();
    }

	/**
	 * @return array
	 */
	public function getDependencies(): array
	{
		return [Car::class];
	}
}
