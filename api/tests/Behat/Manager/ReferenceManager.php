<?php

namespace App\Tests\Behat\Manager;

use Twig\Environment;

class ReferenceManager
{

    private Environment $twig;
    private $references;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }


    public function add($key, $value)
    {
        $this->references[$key] = $value;
    }

    public function remove($key)
    {
        unset($this->references[$key]);
    }


    public function get(string &$string): string
    {
        $template = $this->twig->createTemplate($string);
        $string = $this->twig->render($template, $this->references);
        return $string;
    }

}
