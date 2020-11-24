<?php

namespace SmthDiff\Encore\Variables;

use SmthDiff\Encore\Encore;

class EncoreVariable
{
    /**
     * Find the files version.
     *
     * @param  string  $file
     * @return string
     */
    public function version(string $file): string
    {
        return Encore::$plugin->encore->version($file);
    }

    /**
     * Returns the CSS files version with the appropriate tag.
     *
     * @param  string  $file
     * @return string
     */
    public function entryLinkTag(string $file): string
    {
        return Encore::$plugin->encore->entryLinkTag($file);
    }

    /**
     * Returns the JS files version with the appropriate tag.
     *
     * @param  string  $file
     * @return string
     */
    public function entryScriptTag(string $file, bool $runtime = false): string
    {
        return Encore::$plugin->encore->entryScriptTag($file, $runtime);
    }
}
