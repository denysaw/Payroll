<?php
/**
 * @author Denys Salamatov <denysaw@gmail.com>
 */
declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\SalaryRule;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class SalaryRuleFixtures
 * @package App\DataFixtures
 */
class SalaryRuleFixtures extends Fixture
{

	/**
	 * @param ObjectManager $om
	 */
	public function load(ObjectManager $om)
    {
    	$rule = new SalaryRule();
    	$rule->setName('Country Tax');
    	$rule->setAction('-20%');
	    $om->persist($rule);

	    $rule = new SalaryRule();
	    $rule->setName('Senior Age Bonus');
	    $rule->setCondition('age >= 50');
	    $rule->setAction('+7%');
	    $om->persist($rule);

	    $rule = new SalaryRule();
	    $rule->setName('Huge Family');
	    $rule->setCondition('kids > 2');
	    $rule->setAction('+2%');
	    $om->persist($rule);

	    $rule = new SalaryRule();
	    $rule->setName('Uses Company Car');
	    $rule->setCondition('cars is not empty');
	    $rule->setAction('-500');
	    $om->persist($rule);

	    $om->flush();
    }
}
