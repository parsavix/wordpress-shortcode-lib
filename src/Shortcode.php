<?php

namespace Parsavix\WordPress;

class Shortcode
{
    /**
     * Tag name, e.g. '[my-shortcode]'
     *
     * @var string
     */
    protected $tag;

    /**
     * Name, e.g. 'My Shortcode'
     *
     * @var string
     */
    protected $name;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->init();
        $this->validate();
    }

    /**
     * Used to shortcode properties in subclasses.
     *
     * @return void
     */
    abstract protected function init();

    /**
     * Validates shortcode properties.
     *
     * @throws \Exception
     * @return void
     */
    protected function validate()
    {
        if (empty($this->tag)) {
            throw new \Exception('Setting a value for "tag" property is required.');
        }

        if (empty($this->name)) {
            throw new \Exception('Setting a value for "name" property is required.');
        }
    }

    /**
     * Renders shortcode content.
     *
     * @return void
     */
    abstract protected function render();
}