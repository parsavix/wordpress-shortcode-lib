<?php

require dirname(dirname(__DIR__)) . '/vendor/autoload.php';

function shortcode_exists()
{
    return false;
}

function add_shortcode()
{
    return true;
}

function do_shortcode() {
    return true;
}