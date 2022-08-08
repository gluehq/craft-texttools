<?php

namespace gluehq\texttools;

use gluehq\texttools\twigextensions\TextToolsTwigExtension;

use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;

use yii\base\Event;

class TextTools extends Plugin {
    
    public static $plugin;
    
    public string $schemaVersion = '1.1.0';
    
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        if (Craft::$app->request->getIsSiteRequest()) {
            Craft::$app->view->registerTwigExtension(new TextToolsTwigExtension());
        }

        Event::on(
            Plugins::class,
            Plugins::EVENT_AFTER_INSTALL_PLUGIN,
            function (PluginEvent $event) {
                if ($event->plugin === $this) {
                }
            }
        );

        Craft::info(
            Craft::t(
                'texttools',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }

}
