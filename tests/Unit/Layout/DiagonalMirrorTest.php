<?php

namespace Tests\Unit\Layout;

use PHPUnit\Framework\TestCase;

use Hedronium\Avity\Generators\Hash;
use Hedronium\Avity\Layouts\VerticalMirror;
use Mockery as M;

class DiagonalMirrorTest extends TestCase
{
    public function tearDown(): void
    {
        M::close();
    }

    public function testGridSizeSquare()
    {
        $generator = new Hash;
        $layout = new VerticalMirror($generator);

        $layout->columns(7);
        $layout->rows(7);

        $grid = $layout->drawGrid();

        $this->assertEquals(7, count($grid));

        for ($y = 0; $y < 7; $y++) {
            $this->assertEquals(7, count($grid[$y]));
        }
    }

    public function testGridSizeRectangular()
    {
        $generator = new Hash;
        $layout = new VerticalMirror($generator);

        $layout->columns(14);
        $layout->rows(7);

        $grid = $layout->drawGrid();

        $this->assertEquals(7, count($grid));

        for ($y = 0; $y < 7; $y++) {
            $this->assertEquals(14, count($grid[$y]));
        }
    }

    public function testGridMirroringOdd()
    {
        $size = 5;
        $max_columns = $size/2;

        $generator = new Hash;
        $layout = new VerticalMirror($generator);

        $layout->columns($size);
        $layout->rows($size);

        $grid = $layout->drawGrid();

        for ($y = 0; $y < $size; $y++) {
            for ($x = 0; $x < $max_columns; $x++) {
                $this->assertEquals($grid[$y][$x], $grid[$y][$size-$x-1]);
            }
        }
    }

    public function testGridMirroringEven()
    {
        $size = 4;
        $max_columns = $size/2;

        $generator = new Hash;
        $layout = new VerticalMirror($generator);

        $layout->columns($size);
        $layout->rows($size);

        $grid = $layout->drawGrid();

        for ($y = 0; $y < $size; $y++) {
            for ($x = 0; $x < $max_columns; $x++) {
                $this->assertEquals($grid[$y][$x], $grid[$y][$size-$x-1]);
            }
        }
    }

    public function testPlotting()
    {
        $size = 4;
        $max_columns = $size/2;

        $generator = new Hash;
        $generator->hash('X');

        $generator_b = new Hash;
        $generator_b->hash('X');

        $layout = new VerticalMirror($generator);

        $layout->columns($size);
        $layout->rows($size);

        $grid = $layout->drawGrid();

        for ($y = 0; $y < $size; $y++) {
            for ($x = 0; $x < $max_columns; $x++) {
                $this->assertEquals((bool)($generator_b->next(0, 0)%2), $grid[$y][$x]);
            }
        }
    }
}
