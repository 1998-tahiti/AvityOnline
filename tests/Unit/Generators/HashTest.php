<?php

namespace Tests\Unit\Generators;

use PHPUnit\Framework\TestCase;

use Hedronium\Avity\Generators\Hash;
use Mockery as M;

class HashTest extends TestCase
{
    public function tearDown(): void
    {
        M::close();
    }

    public function testSameHash()
    {
        $generator_a = new Hash();
        $generator_a->hash('TOMATO');

        $generator_b = new Hash();
        $generator_b->hash('TOMATO');

        $cycles = 10;
        while ($cycles--) {
            $this->assertSame(
                $generator_a->next($cycles, -1*$cycles),
                $generator_b->next($cycles, -1*$cycles)
            );
        }
    }

    public function testDifferentHash()
    {
        $generator_a = new Hash();
        $generator_a->hash('POTATO');

        $generator_b = new Hash();
        $generator_b->hash('TOMATO');

        $seq_a = [];
        $seq_b = [];

        $cycles = 10;
        while ($cycles--) {
            array_push($seq_a, $generator_a->next($cycles, -1*$cycles));
            array_push($seq_b, $generator_b->next($cycles, -1*$cycles));
        }

        $this->assertNotEquals($seq_a, $seq_b);
    }
}
