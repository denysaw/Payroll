<?php
/**
 * @author Denys Salamatov <denysaw@gmail.com>
 */
declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SalaryRuleRepository")
 * @ORM\Table(name="salary_rule")
 * @ORM\HasLifecycleCallbacks
 */
class SalaryRule extends BaseEntity
{

	/**
	 * @var string
	 *
	 * @ORM\Column(type="string")
	 * @Assert\NotBlank()
	 * @Assert\Length(min=3, max=30)
	 */
	protected $name;

	/**
	 * @var string
	 *
	 * @ORM\Column(type="string", name="conditions", nullable=true)
	 * @Assert\NotBlank()
	 */
	protected $condition;

	/**
	 * @var string
	 *
	 * @ORM\Column(type="string")
	 * @Assert\NotBlank()
	 */
	protected $action;


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
	 * @return bool
	 */
	public function hasCondition(): bool
	{
		return !!$this->condition;
	}

	/**
	 * @return string
	 */
	public function getCondition(): string
	{
		return (string) $this->condition;
	}

	/**
	 * @param string $condition
	 */
	public function setCondition(string $condition): void
	{
		$this->condition = $condition;
	}

	/**
	 * @return string
	 */
	public function getAction(): string
	{
		return $this->action;
	}

	/**
	 * @param string $action
	 */
	public function setAction(string $action): void
	{
		$this->action = $action;
	}
}