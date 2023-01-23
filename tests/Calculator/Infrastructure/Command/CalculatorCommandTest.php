<?php

namespace Tests\Calculator\Infrastructure\Command;

use App\Calculator\Infrastructure\Command\CalculatorCommand;
use App\Calculator\Domain\Service\CalculatorService;
use App\Calculator\Domain\Exception\CalculatorException;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class CalculatorCommandTest extends TestCase
{
    private $calculatorService;
    private $calculatorCommand;
    private $commandTester;

    public function setUp(): void
    {
        $this->calculatorService = $this->createMock(CalculatorService::class);
        $this->calculatorCommand = new CalculatorCommand($this->calculatorService);
        $application = new Application();
        $application->add($this->calculatorCommand);
        $this->commandTester = new CommandTester($this->calculatorCommand);
    }

    public function testExecute()
    {
        $this->calculatorService->expects($this->once())
            ->method('calculate')
            ->with('5 + 2')
            ->willReturn(7);

        $this->calculatorService->expects($this->once())
            ->method('getResult')
            ->willReturn(7);

        $this->commandTester->execute(['expression' => '5 + 2']);
        $this->assertStringContainsString('7', $this->commandTester->getDisplay());
    }

    public function testExecuteThrowExceptionInvalidCharacters()
    {
        $this->calculatorService->expects($this->once())
            ->method('calculate')
            ->with('5 & 2')
            ->will($this->throwException(new CalculatorException('The expression contains invalid characters.')));

        $this->commandTester->execute(['expression' => '5 & 2']);
        $this->assertStringContainsString('The expression contains invalid characters.', $this->commandTester->getDisplay());
    }

    public function testExecuteThrowExceptionOperatorsAtStartOrEnd()
    {
        $this->calculatorService->expects($this->once())
            ->method('calculate')
            ->with('+ 2 +')
            ->will($this->throwException(new CalculatorException('The expression starts or ends with an operator.')));

        $this->commandTester->execute(['expression' => '+ 2 +']);
        $this->assertStringContainsString('The expression starts or ends with an operator.', $this->commandTester->getDisplay());
    }

    public function testExecuteThrowExceptionConsecutiveOperators()
    {
        $this->calculatorService->expects($this->once())
            ->method('calculate')
            ->with('2 ++ 5')
            ->will($this->throwException(new CalculatorException('The expression contains consecutive operators.')));

        $this->commandTester->execute(['expression' => '2 ++ 5']);
        $this->assertStringContainsString('The expression contains consecutive operators.', $this->commandTester->getDisplay());
    }
}
