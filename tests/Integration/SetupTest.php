<?php

use Parsavix\WordPress\Shortcode;
use Parsavix\WordPress\Shortcodes\DuplicateShortcodeException;
use PHPUnit\Framework\TestCase;

class SetupTest extends TestCase
{
    protected function setUp()
    {
        global $shortcode_tags;

        parent::setUp();

        $shortcode_tags = [];
    }

    /** @test */
    public function ensure_gets_registered_when_valid_shortcode_is_given()
    {
        Shortcode::setupShortcode(new class extends Shortcode
        {
            protected function init()
            {
                $this->tag = 'shortcode-1';
                $this->name = 'Shortcode 1';
            }

            public function render()
            {

            }

        });

        $this->assertTrue(shortcode_exists('shortcode-1'));
    }

    /** @test */
    public function ensure_throw_exception_when_duplicate_shortcode_is_given()
    {
        $this->expectException(DuplicateShortcodeException::class);

        Shortcode::setupShortcode(new class extends Shortcode
        {
            protected function init()
            {
                $this->tag = 'shortcode-1';
                $this->name = 'Shortcode 1';
            }

            public function render()
            {
            }
        });

        Shortcode::setupShortcode(new class extends Shortcode
        {
            protected function init()
            {
                $this->tag = 'shortcode-1';
                $this->name = 'Shortcode 1';
            }

            public function render()
            {
            }

        });
    }
}