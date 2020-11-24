<?php

namespace SmthDiff\Encore\Services;

use SmthDiff\Encore\Encore;
use Craft;
use craft\base\Component;
use Exception;

class EncoreService extends Component
{
    /**
     * Path to the root directory.
     *
     * @var string
     */
    protected $rootPath;

    /**
     * Path to the public directory.
     *
     * @var string
     */
    protected $publicPath;

    /**
     * Path to the asset directory.
     *
     * @var string
     */
    protected $assetPath;

    /**
     * Full path to the asset directory.
     *
     * @var string
     */
    protected $assetFullPath;

    /**
     * Name of the manifest file.
     *
     * @var string
     */
    protected $manifestName = 'manifest.json';

    /**
     * Path of the manifest file.
     *
     * @var string
     */
    protected $manifestPath;

    /**
     * @inheritdoc
     */
    public function init(): void
    {
        $settings = Encore::$plugin->getSettings();

        $this->rootPath = rtrim(CRAFT_BASE_PATH, '/');
        $this->publicPath = trim($settings->publicPath, '/');
        $this->assetPath = trim($settings->assetPath, '/');
        $this->assetFullPath = implode('/', array_filter([
            $this->rootPath,
            $this->publicPath,
            $this->assetPath,
        ]));

        $this->manifestPath = implode('/', [
            $this->assetFullPath,
            $this->manifestName
        ]);
    }

    /**
     * Find the files version.
     *
     * @param string $file
     * @return string
     */
    public function version(string $file): string
    {
        try {
            $manifest = $this->readManifestFile();
        } catch (Exception $e) {
            Craft::info('Encore: ' . printf($e->getMessage()), __METHOD__);
        }

        $fileKey = '/' . ltrim($file, '/');
        if (is_array($manifest) && isset($manifest[$fileKey])) {
            $file = $manifest[$fileKey];
        }

        return '/' . implode('/', array_filter([
            $this->assetPath,
            ltrim($file, '/')
        ]));
    }

    /**
     * Returns the CSS files version with the appropriate tag.
     *
     * @param string $file
     * @return string
     */
    public function entryLinkTag(string $file): string
    {
		return '<link rel="stylesheet" href="'.$this->version($file).'">';
    }

	/**
	 * Returns the JS files version with the appropriate tag.
	 *
	 * @param string $file
	 * @param bool $runtime
	 * @return string
	 */
	public function entryScriptTag(string $file, bool $runtime = false): string
	{
		$scripts = '';

		if ($runtime === true) {
			$scripts .= '<script src="'.$this->version('runtime.js').'"></script>';
		}

		$scripts .= '<script src="'.$this->version($file).'"></script>';
		return $scripts;
	}

    /**
     * Locate manifest and convert to an array.
     *
     * @return array|bool
     */
    protected function readManifestFile()
    {
        if (file_exists($this->manifestPath)) {
            return json_decode(
                file_get_contents($this->manifestPath),
                true
            );
        }

        return false;
    }
}
