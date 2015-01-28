<?php

/**
 * Redirect short summary.
 *
 * Redirect description.
 *
 * @version 1.0
 * @author Tom
 */
class Redirect
{
    public function to($location)
    {
        header('Location:'.$location);
        die();
    }
}
