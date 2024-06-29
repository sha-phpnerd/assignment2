<?php

if (!function_exists('dd')) {
    function dd(mixed $v): void
    {
        var_dump($v);
        die();
    }
}
