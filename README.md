# SmthDiff Craft Plugin for Webpack Encore 

## Requirements

This plugin requires Craft CMS 3.0.0 or later.

## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:
```bash
cd /path/to/project
```

2. Then tell Composer to load the plugin:
```bash
composer require smthdiff/craft-encore
```

3. In the Craft Control Panel, go to `Settings → Plugins` and click the "Install" button for **Webpack Encore**.

## Configuration

To configure Webpack Encore go to `Settings → Plugins → Webpack Encore` in the Craft Control Panel.

The available settings are:

  * **Asset Path** - The path of the asset directory where the project stores the source files
  * **Build Path** - The path of the asset directory where Webpack Encore stores the compiled files

**Usage of Asset Path**

`/assets/` in project root contains the CSS, JS, Images and Font Files.

**Usage of Build Path**

`/web/build/` in project root contains the CSS, JS, Images and Font Files.

## Usage

Add versioned CSS files.
```twig
{{ craft.encore.entryLinkTag('app') | raw }}
```

Add versioned JS files.
```twig
{{ craft.encore.entryScriptTag('app') | raw }}
```

## License

Craft Encore is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT/).
