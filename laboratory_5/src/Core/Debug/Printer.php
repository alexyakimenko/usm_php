<?php

namespace App\Core\Debug;

class Printer
{
    /**
     * Prints an array in a readable format.
     *
     * @param array $data The array to be printed.
     * @return void
     */
    public static function print_r(array $data): void {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }
}