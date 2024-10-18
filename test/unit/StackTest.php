<?php declare(strict_types=1);

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class StackTest extends TestCase{

    /* #[TestDox('suma de dos numeros enteros')]*/   
    public function test_sumar2(): void{

        $num1 = 8;
        $num2 = 1;

        //chequeo de validez

        $this->assertSame(10, $num1 + $num2);
    }
    
}