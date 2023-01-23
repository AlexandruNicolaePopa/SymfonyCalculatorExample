<?php

namespace App\Calculator\Infrastructure\Command;

use App\Calculator\Domain\Service\CalculatorService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CalculatorCommand extends Command
{
    protected static $defaultName = 'app:calculator';

    private $calculatorService;

    public function __construct(CalculatorService $calculatorService)
    {
        $this->calculatorService = $calculatorService;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Perform basic mathematical operations')
            ->addArgument('expression', InputArgument::REQUIRED, 'Enter mathematical expression')
        ;
    }

    /**
     * @return int added this to avoid errors and supress the deprecated use message, the return might be added as int in the future release
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $expression = $input->getArgument('expression');
        $this->calculatorService->calculate($expression);
        $result = $this->calculatorService->getResult();
        $output->writeln("Result: " . $result);
        return 0;
    }
}
