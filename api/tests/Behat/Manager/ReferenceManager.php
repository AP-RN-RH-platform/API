<?php

namespace App\Tests\Behat\Manager;

use Twig\Environment;

class ReferenceManager
{

    private static Environment $twig;
    private static $references;

    public function __construct(Environment $twig)
    {
        self::$twig = $twig;
    }


    public static function add($key, $value)
    {
        self::$references[$key] = $value;
    }

    public function remove($key)
    {
        unset(self::$references[$key]);
    }


    public static function get(string &$string): string
    {
        $template = self::$twig->createTemplate($string);
        $string = self::$twig->render($template, self::$references);
        return $string;
    }

}
