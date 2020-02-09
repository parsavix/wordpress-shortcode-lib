<?php

namespace Parsavix\WordPress\Shortcodes;

use Throwable;

class DuplicateShortcodeException extends \Exception
{
    public function __construct(
        $message = "",
        $code = 0,
        Throwable $previous = null
    ) {
        if (empty($message)) {
            $message = 'Duplicate shortcode key given.';
        }

        parent::__construct($message, $code, $previous);
    }

}