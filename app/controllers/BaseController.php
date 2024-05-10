<?php
namespace App\Controllers;

abstract class BaseController {

    /**
     * Redirect method
     * @param string $path
     */
    protected function redirect(string $path) {
        header("Location: $path");
        die();
    }
}
