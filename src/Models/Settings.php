<?php

namespace SmthDiff\Encore\Models;

use craft\base\Model;

class Settings extends Model
{
    /**
     * Path to the public directory.
     *
     * @var string
     */
    public $publicPath = 'web';

    /**
     * Path to the asset directory.
     *
     * @var string
     */
    public $assetPath = 'build';

    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            [['publicPath', 'assetPath'], 'required'],
            [['publicPath', 'assetPath'], 'string'],
        ];
    }
}
