<?php

namespace gluehq\texttools\twigextensions;

use gluehq\texttools\TextTools;
use Craft;

class TextToolsTwigExtension extends \Twig_Extension {
    
    public function getName()
    {
        return 'TextTools';
    }

    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('texttools', [$this, 'texttools']),
        ];
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('texttools', [$this, 'texttools']),
        ];
    }

    public function texttools($str)
    {
        return urldecode($str);
    }
    
}
