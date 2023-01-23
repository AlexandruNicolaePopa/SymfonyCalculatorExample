<?php

namespace App\Calculator\Infrastructure\Command;

use App\Calculator\Domain\Service\CalculatorService;
use App\Calculator\Domain\Exception\CalculatorException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CalculatorCommand extends Command
{
    protected static $defaultName = 'app:calculator';

    private $calculatorService;

    /**
     * The constructor function is used to create a new instance of the class
     * 
     * @param CalculatorService calculatorService The name of the service injected.
     */
    public function __construct(CalculatorService $calculatorService)
    {
        $this->calculatorService = $calculatorService;
        parent::__construct();
    }

    /**
     * The configure() function is used to set the description of the command and to add arguments to
     * the command.
     * 
     * The description of the command is set using the setDescription() function.
     * 
     * The addArgument() function is used to add arguments to the command. The first argument is the
     * name of the argument, the second argument is the mode of the argument. The mode of the argument
     * can be InputArgument::REQUIRED or InputArgument::OPTIONAL. The third argument is the description
     * of the argument.
     */
    protected function configure()
    {
        $this
            ->setDescription('Perform basic mathematical operations')
            ->addArgument('expression', InputArgument::REQUIRED, 'Enter mathematical expression');
    }


    /**
     * It takes an input and an output, and then it tries to calculate the expression, and if it fails,
     * it outputs an error message, and if it succeeds, it outputs the result
     * 
     * @param InputInterface input The input object is an instance of the class
     * Symfony\Component\Console\Input\InputInterface, which represents the user input.
     * @param OutputInterface output The output interface
     * 
     * @return int added this to avoid errors and supress the deprecated use message, the return might be added as int in the future release
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $expression = $input->getArgument('expression');
            $this->calculatorService->calculate($expression);
        } catch (CalculatorException $e) {
            $output->writeln(sprintf("<error>%s</error>", $e->getMessage()));
            return 1;
        }

        $output->writeln($this->calculatorService->getResult());
        return 0;
    }
}
