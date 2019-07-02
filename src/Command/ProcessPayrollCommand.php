<?php
/**
 * @author Denys Salamatov <denysaw@gmail.com>
 */
declare(strict_types=1);

namespace App\Command;

use App\Service\SalaryService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ProcessPayrollCommand extends Command
{

    protected static $defaultName = 'process:payroll';

	/**
	 * @var SalaryService
	 */
    protected $salaryService;


	/**
	 * ProcessPayrollCommand constructor.
	 * @param SalaryService $salaryService
	 */
	public function __construct(SalaryService $salaryService)
	{
		$this->salaryService = $salaryService;
		parent::__construct();
	}

	protected function configure()
    {
        $this->setDescription('Pay salaries to all employees');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $io->title('Payroll');
        $io->note('processing salary payouts...');

        $this->salaryService->setOutput($io);
		$this->salaryService->payAll();

        $io->success('All salaries paid.');
    }
}
