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

    public function texttools($tag, $argument = false) {
        
        // NB the incoming data has not been converted to html entities
            
        // Replace consecutive br tags with just one
        $tag = preg_replace('/(?:<br\s*\/*>)+/', '<br>', $tag);
        
        // Remove any br tags before closing block tag
        $tag = preg_replace('/<br\s*\/*>(<\/(?:p|h[1-6]|a|blockquote|li)>)/', '$1', $tag);
        
        // Remove empty p tags
        $tag = preg_replace('/<p>\s*<\/p>/', '', $tag);
        
        // Remove any space before closing block tag
        $tag = preg_replace('/(\s+)<\/(p|h[1-6]|a|blockquote|li)>/', '</$2>', $tag);
            
        // Add a non-breaking space (requires space before closing tag to be removed first)
        $tag = preg_replace('/\s+([^>\s]+)<\/(p|h[3-6]|a|blockquote|li)>/', '&#160;$1</$2>', $tag);

        // Left in for legacy support because you should use Twig's {{ entry.text|striptags('<a><strong><em>')|raw }} (stating preserved tags) instead
        if ($argument == 'strip_p_tags') {
            $tag = preg_replace('/<\/?p>/', '', $tag);
        }

        // Done
        echo $tag;// Use echo not return to output rendered html
        
    }

}
