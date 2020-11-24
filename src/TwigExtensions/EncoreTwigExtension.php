<?php

namespace SmthDiff\Encore\TwigExtensions;

use SmthDiff\Encore\Encore;
use Twig_Extension;
use Twig_SimpleFilter;
use Twig_SimpleFunction;

class EncoreTwigExtension extends Twig_Extension
{
	/**
	 * @inheritdoc
	 */
	public function getName(): string
	{
		return 'Encore';
	}

	/**
	 * @inheritdoc
	 */
	public function getFilters(): array
	{
		return [
			new Twig_SimpleFilter('encore', [$this, 'encore']),
		];
	}

	/**
	 * @inheritdoc
	 */
	public function getFunctions(): array
	{
		return [
			new Twig_SimpleFunction('encore', [$this, 'encore']),
		];
	}

	/**
	 * Returns versioned file or the entire tag.
	 *
	 * @param string $tag
	 * @return string
	 */
	public function encore(string $tag): string
	{
		return Encore::$plugin->encore->version($tag);
	}
}
