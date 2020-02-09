<?php

namespace Parsavix\WordPress;

use Parsavix\Exceptions\RequiredPropertyException;
use Parsavix\WordPress\Shortcodes\DuplicateShortcodeException;

abstract class Shortcode
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
     * Used to set shortcode properties in subclasses.
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
            throw new RequiredPropertyException('tag');
        }

        if (empty($this->name)) {
            throw new RequiredPropertyException('name');
        }
    }

    /**
     * Renders shortcode content.
     *
     * @return void
     */
    abstract protected function render();

    /**
     * Registers a shortcode in WordPress.
     *
     * @return void
     */
    public static function setupShortcode(Shortcode $shortcode)
    {
        if (shortcode_exists($shortcode->getTag())) {
            throw new DuplicateShortcodeException();
        }

        self::setupInWp($shortcode);
        self::setupInWpbakery($shortcode);
    }

    public static function setupInWp(Shortcode $shortcode)
    {
        add_shortcode($shortcode->getTag(), function () use ($shortcode) {
            ob_start();
            $shortcode->render();
            return ob_get_clean();
        });
    }

    public static function setupInWpbakery(Shortcode $shortcode)
    {
        if (!defined('WPB_VC_VERSION')) {
            return;
        }

        vc_map([
            'base' => $shortcode->tag,
            'name' => $shortcode->name
        ]);
    }

    /**
     * Registers a shortcode in WordPress.
     *
     * @return void
     */
    public function setup()
    {
        self::setupShortcode($this);
    }

    /**
     * Returns shortcode tag.
     *
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }
}