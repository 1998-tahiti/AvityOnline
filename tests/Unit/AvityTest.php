<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

use Hedronium\Avity\Avity;

use Hedronium\Avity\Generator;
use Hedronium\Avity\Generators\Hash;
use Hedronium\Avity\Generators\Random;

use Hedronium\Avity\Layout;
use Hedronium\Avity\Layouts\VerticalMirror;
use Hedronium\Avity\Layouts\HorizontalMirror;

use Hedronium\Avity\Style;
use Hedronium\Avity\Styles\Circle;
use Hedronium\Avity\Styles\Square;

use Hedronium\Avity\Output;

use Mockery as M;

class AvityTest extends TestCase
{
    protected $avity = null;
    protected $imagine = null;

    public function setUp(): void
    {
        $this->imagine = new \Imagine\Gd\Imagine();
    }

    public function tearDown(): void
    {
        M::close();
    }

    public function testColumns()
    {
        $columns = 4;
        $generator = new Random;
        $layout = M::mock(Layout::class)->shouldReceive('columns')
            ->once()->with($columns)->andReturnNull()->mock();
        $style = new Square($layout, $generator, $this->imagine);
        $avity = new Avity($generator, $layout, $style, $this->imagine);
        $this->assertSame($avity, $avity->columns($columns));
    }

    public function testRows()
    {
        $rows = 4;
        $generator = new Random;
        $layout = M::mock(Layout::class)->shouldReceive('rows')
            ->once()->with($rows)->andReturnNull()->mock();

        $style = new Square($layout, $generator, $this->imagine);
        $avity = new Avity($generator, $layout, $style, $this->imagine);
        $this->assertSame($avity, $avity->rows($rows));
    }

    public function testHeight()
    {
        $height = 200;
        $generator = new Random;
        $layout = new VerticalMirror($generator);

        $style = M::mock(Style::class)->shouldReceive('height')
            ->once()->with($height)->andReturnNull()->mock();

        $avity = new Avity($generator, $layout, $style, $this->imagine);
        $this->assertSame($avity, $avity->height($height));
    }

    public function testWidth()
    {
        $width = 200;
        $generator = new Random;
        $layout = new VerticalMirror($generator);

        $style = M::mock(Style::class)->shouldReceive('width')
            ->once()->with($width)->andReturnNull()->mock();

        $avity = new Avity($generator, $layout, $style, $this->imagine);
        $this->assertSame($avity, $avity->width($width));
    }

    public function testPadding()
    {
        $padding = 20;
        $generator = new Random;
        $layout = new VerticalMirror($generator);

        $style = M::mock(Style::class)->shouldReceive('padding')
            ->once()->with($padding)->andReturnNull()->mock();

        $avity = new Avity($generator, $layout, $style, $this->imagine);
        $this->assertSame($avity, $avity->padding($padding));
    }

    public function testHashWithHashableGenerator()
    {
        $hash =  'Hehe';
        $generator = M::mock(Hash::class)->shouldReceive('hash')
            ->once()->with($hash)->andReturnNull()->mock();

        $layout = new VerticalMirror($generator);

        $style = new Square($layout, $generator, $this->imagine);

        $avity = new Avity($generator, $layout, $style, $this->imagine);
        $this->assertSame($avity, $avity->hash($hash));
    }

    public function testHashWithNonHashableGenerator()
    {
        $this->expectException('Exception');

        $generator = new Random;
        $layout = new VerticalMirror($generator);
        $style = new Square($layout, $generator, $this->imagine);
        $avity = new Avity($generator, $layout, $style, $this->imagine);
        $avity->hash('XXX');
    }

    public function testStyle()
    {
        $generator = new Random;
        $layout = new VerticalMirror($generator);
        $style = new Square($layout, $generator, $this->imagine);
        $avity = new Avity($generator, $layout, $style, $this->imagine);

        $this->assertSame($style, $avity->style());
    }

    public function testLayout()
    {
        $generator = new Random;
        $layout = new VerticalMirror($generator);
        $style = new Square($layout, $generator, $this->imagine);
        $avity = new Avity($generator, $layout, $style, $this->imagine);

        $this->assertSame($layout, $avity->layout());
    }

    public function testGenerator()
    {
        $generator = new Random;
        $layout = new VerticalMirror($generator);
        $style = new Square($layout, $generator, $this->imagine);
        $avity = new Avity($generator, $layout, $style, $this->imagine);

        $this->assertSame($generator, $avity->generator());
    }

    public function testDrawer()
    {
        $generator = new Random;
        $layout = new VerticalMirror($generator);
        $style = new Square($layout, $generator, $this->imagine);
        $avity = new Avity($generator, $layout, $style, $this->imagine);

        $this->assertSame($this->imagine, $avity->drawer());
    }

    public function testGenerate()
    {
        $avity = Avity::init();
        $this->assertInstanceOf(Output::class, $avity->generate());
    }
}
