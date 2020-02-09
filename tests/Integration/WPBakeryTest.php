<?php

use Parsavix\WordPress\Shortcode;
use PHPUnit\Framework\TestCase;

class WPBakeryTest extends TestCase
{
    /** @test */
    public function ensure_shortcode_gets_registered_in_wpbakery()
    {
        $shortcode = new class extends Shortcode
        {
            protected function init()
            {
                $this->tag = 'tag-1';
                $this->name = 'Tag 1';
            }

            protected function render()
            {

            }
        };

        $shortcode->setup();

        $this->assertTrue(WPBMap::exists('tag-1'));
    }
}