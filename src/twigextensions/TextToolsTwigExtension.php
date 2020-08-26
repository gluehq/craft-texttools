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

    public function texttools($tag) {
        
        // NB the incoming data has not been converted to html entities
        
        // Clean up HTML and Purify HTML are deactivated on field
        
        // Replace consecutive br tags with just one
        $tag = preg_replace('/(?:<br\s*\/*>)+/', '<br>', $tag);
        
        // Remove any br tags before closing block tag
        $tag = preg_replace('/<br\s*\/*>(<\/(?:p|h[1-6]|blockquote|li)>)/', '$1', $tag);
        
        // Remove empty p tags
        $tag = preg_replace('/<p>\s*<\/p>/', '', $tag);
        
        // Remove any space before closing block tag
        $tag = preg_replace('/(\s+)<\/(p|h[1-6]|blockquote|li)>/', '</$2>', $tag);
        
        // Add a non-breaking space (requires space before closing tag to be removed first)
        $tag = preg_replace('/\s+([^>\s]+)<\/(p|h[1-6]|blockquote|li)>/', '&#160;$1</$2>', $tag);

        // Done
        echo $tag;// Use echo not return to output rendered html
        
    }

}
