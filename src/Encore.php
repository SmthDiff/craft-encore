<?php

namespace SmthDiff\Encore;

use SmthDiff\Encore\Models\Settings;
use SmthDiff\Encore\TwigExtensions\EncoreTwigExtension;
use SmthDiff\Encore\Variables\EncoreVariable;
use Craft;
use craft\base\Plugin;
use craft\web\twig\variables\CraftVariable;
use yii\base\Event;

class Encore extends Plugin
{
    /** @var Encore */
    public static $plugin;

	/** @var string */
	public $schemaVersion = '1.0.0';

    /**
     * @inheritdoc
     */
    public function init(): void
    {
        parent::init();
        self::$plugin = $this;

        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function (Event $event) {
                /** @var CraftVariable $variable */
                $variable = $event->sender;
                $variable->set('encore', EncoreVariable::class);
            }
        );

        Craft::$app->view->registerTwigExtension(new EncoreTwigExtension());

        Craft::info('Encore plugin loaded', __METHOD__);
    }

    /**
     * @inheritdoc
     */
    protected function createSettingsModel(): Settings
    {
        return new Settings();
    }

    /**
     * @inheritdoc
     */
    protected function settingsHtml(): string
    {
        return Craft::$app->view->renderTemplate(
            'encore/settings',
            ['settings' => $this->getSettings()]
        );
    }
}
