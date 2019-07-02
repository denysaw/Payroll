<?php
/**
 * @author Denys Salamatov <denysaw@gmail.com>
 */
declare(strict_types=1);

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Car;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class CarFixtures
 * @package App\DataFixtures
 */
class CarFixtures extends Fixture
{

	public const CAR_BRANDS = ['Tesla', 'Chevrolet', 'Jeep', 'Dodge', 'Mazda', 'Subaru', 'Kia', 'Audi', 'BMW', 'Hyundai'];
	public const CAR_COLORS = ['red', 'orange', 'yellow', 'green', 'blue', 'indigo', 'violet'];
	public const CAR_TYPES  = ['hatchback', 'sedan', 'MPV', 'van', 'crossover', 'coupe', 'wagon'];
	public const CAR_FUELS  = ['92', '95', 'diesel', 'gas', 'hybrid', 'electro'];

	/**
	 * @param ObjectManager $om
	 */
	public function load(ObjectManager $om)
    {
	    $faker = Factory::create();
	    $count = 30;

	    while ($count--) {
		    $car = new Car();
		    $car->setModel($faker->randomElement(self::CAR_BRANDS). ' '. ucfirst($faker->word));
		    $car->setColor($faker->randomElement(self::CAR_COLORS));
		    $car->setType($faker->randomElement(self::CAR_TYPES));
		    $car->setFuel($faker->randomElement(self::CAR_FUELS));
		    $car->setPower($faker->numberBetween(60, 250));
		    $om->persist($car);
	    }

	    $om->flush();
    }
}
