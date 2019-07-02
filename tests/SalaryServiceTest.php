<?php
/**
 * @author Denys Salamatov <denysaw@gmail.com>
 */
namespace App\Tests;

use App\Entity\Employee;
use App\Service\SalaryService;
use App\Repository\CarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class SalaryServiceTest extends KernelTestCase
{

	/**
	 * @var EntityManagerInterface
	 */
	private $em;

	/**
	 * @var SalaryService
	 */
	private $salaryService;

	/**
	 * @var CarRepository
	 */
	private $carRepository;


	public function setUp(): void
	{
		self::bootKernel();

		$this->em = self::$container->get('doctrine.orm.entity_manager');
		$this->salaryService = self::$container->get('App\Service\SalaryService');
		$this->carRepository = self::$container->get('App\Repository\CarRepository');
	}

	public function testAlice()
    {
    	$alice = new Employee();
    	$alice->setName('Alice');
    	$alice->setAge(26);
    	$alice->setKids(2);
    	$alice->setSalary(6000);
	    $this->em->persist($alice);
	    $this->em->flush();

	    $net = $this->salaryService->calculate($alice);

        $this->assertEquals(4800, $net);

        $this->em->remove($alice);
	    $this->em->flush();
    }

	public function testBob()
    {
    	$bob = new Employee();
    	$bob->setName('Bob');
    	$bob->setAge(52);
    	$bob->addCar($this->carRepository->getOneRandom());
    	$bob->setSalary(4000);
	    $this->em->persist($bob);
	    $this->em->flush();

	    $net = $this->salaryService->calculate($bob);

        $this->assertEquals(2980, $net);

	    $this->em->remove($bob);
	    $this->em->flush();
    }

	public function testCharlie()
    {
    	$charlie = new Employee();
    	$charlie->setName('Charlie');
    	$charlie->setAge(36);
	    $charlie->setKids(3);
    	$charlie->addCar($this->carRepository->getOneRandom());
    	$charlie->setSalary(5000);
	    $this->em->persist($charlie);
	    $this->em->flush();

	    $net = $this->salaryService->calculate($charlie);

        $this->assertEquals(3600, $net);

	    $this->em->remove($charlie);
	    $this->em->flush();
    }
}
