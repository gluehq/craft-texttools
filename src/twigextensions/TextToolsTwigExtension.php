<?php

namespace gluehq\texttools\twigextensions;

use gluehq\texttools\TextTools;
use Craft;

class TextToolsTwigExtension extends \Twig\Extension\AbstractExtension {
    
    public function getName()
    {
        return 'TextTools';
    }

    public function getFilters()
    {
        return [
            new \Twig\TwigFilter('texttools', [$this, 'texttools']),
        ];
    }

    public function getFunctions()
    {
        return [
            new \Twig\TwigFunction('texttools', [$this, 'texttools']),
        ];
    }

    public function texttools($tag, $argument = false) {
        
        // NB the incoming data has not been converted to html entities
            
        // Two or more br tags in a paragraph, with any spaces or non-breaking spaces between, are a paragraph break typed the old way
        $tag = preg_replace('/(?:\s|&nbsp;|&#160;|\x{A0})*(?:<br\s*\/*>(?:\s|&nbsp;|&#160;|\x{A0})*){2,}/u', '</p><p>', $tag);

        // Replace consecutive br tags with just one
        $tag = preg_replace('/(?:<br\s*\/*>)+/', '<br>', $tag);
        
        // Remove any mix of br tags, spaces and non-breaking spaces before closing block tag
        // Non-breaking spaces arrive as the raw character or as an entity; \s covers neither, hence the explicit list
        $tag = preg_replace('/(?:<br\s*\/*>|\s|\x{A0}|&nbsp;|&#160;)+(<\/(?:p|h[1-6]|a|blockquote|li)>)/u', '$1', $tag);
        
        // Remove empty text tags, including those holding only the spacing just stripped
        $tag = preg_replace('/<(p|h[1-6]|a|li|blockquote)[^>]*>\s*<\/(p|h[1-6]|a|li|blockquote)>/', '', $tag);
            
        // Add a non-breaking space (requires space before closing tag to be removed first)
        $tag = preg_replace('/\s+([^>\s]+)<\/(p|h[3-6]|a|li|blockquote)>/', '&#160;$1</$2>', $tag);

        // Left in for legacy support because you should use Twig's {{ entry.text|striptags('<a><strong><em>')|raw }} (stating preserved tags) instead
        if ($argument == 'strip_p_tags') {
            $tag = preg_replace('/<\/?p>/', '', $tag);
        }

        // Done
        echo $tag;// Use echo not return to output rendered html
        
    }

}
