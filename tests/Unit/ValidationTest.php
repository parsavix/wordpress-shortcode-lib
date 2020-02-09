<?php

use Parsavix\Exceptions\RequiredPropertyException;
use Parsavix\WordPress\Shortcode;
use PHPUnit\Framework\TestCase;

class ValidationTest extends TestCase
{
    /** @test */
    public function ensure_throw_exception_when_required_property_not_given()
    {
        $this->expectException(RequiredPropertyException::class);

        $shortcode = new class extends Shortcode
        {
            protected function init()
            {
            }

            protected function render()
            {
            }
        };
    }

    /** @test */
    public function ensure_no_expection_when_required_data_is_given()
    {
        $shortcode = new class extends Shortcode
        {
            protected function init()
            {
                $this->tag = 'tag';
                $this->name = 'name';
            }

            protected function render()
            {
            }
        };

        $this->assertNull(null);
    }
}