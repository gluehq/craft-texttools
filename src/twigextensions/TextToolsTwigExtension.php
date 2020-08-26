<?php
/**
 * String Urldecode plugin for Craft CMS 3.x
 *
 * Twig filters to urldecode a string.
 *
 * @link      https://www.akagibi.com
 * @copyright Copyright (c) 2019 Akagibi
 */

namespace gluehq\texttools\twigextensions;

use gluehq\texttools\TextTools;

use Craft;

/**
 * @author    Akagibi
 * @package   StringUrldecode
 * @since     1
 */
class TextToolsTwigExtension extends \Twig_Extension
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'TextTools';
    }

    /**
     * @inheritdoc
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('texttools', [$this, 'texttools']),
        ];
    }

    /**
     * @inheritdoc
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('texttools', [$this, 'texttools']),
        ];
    }

    /**
     * @param null $text
     *
     * @return string
     */
    public function texttools($str)
    {
        return urldecode($str);
    }
}
