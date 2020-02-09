<?php

use Parsavix\WordPress\Shortcode;
use PHPUnit\Framework\TestCase;

class RenderTest extends TestCase
{
    protected function setUp()
    {
        global $shortcode_tags;

        parent::setUp();

        $shortcode_tags = [];
    }


    /** @test */
    public function ensure_shortcode_content_gets_rendered()
    {
        $shortcode = new class extends Shortcode
        {
            protected function init()
            {
                $this->tag = 'shortcode-1';
                $this->name = 'Shortcode 1';
            }

            public function render()
            {

            }
        };

        $shortcode->setup();

        $this->assertEquals('', do_shortcode('[shortcode-1]'));

        $shortcode = new class extends Shortcode
        {
            protected function init()
            {
                $this->tag = 'shortcode-2';
                $this->name = 'Shortcode 2';
            }

            public function render()
            {
                echo "Hello";
            }
        };

        $shortcode->setup();

        $this->assertEquals('Hello', do_shortcode('[shortcode-2]'));
    }
}