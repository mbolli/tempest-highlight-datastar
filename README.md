# Datastar Language Support for tempest/highlight

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mbolli/tempest-highlight-datastar.svg?style=flat-square)](https://packagist.org/packages/mbolli/tempest-highlight-datastar)
[![PHP Version](https://img.shields.io/packagist/php-v/mbolli/tempest-highlight-datastar.svg?style=flat-square)](https://packagist.org/packages/mbolli/tempest-highlight-datastar)
[![PHPStan Level 10](https://img.shields.io/badge/PHPStan-level%2010-brightgreen.svg?style=flat-square)](https://phpstan.org/)
[![License](https://img.shields.io/packagist/l/mbolli/tempest-highlight-datastar.svg?style=flat-square)](LICENSE)

[Datastar](https://data-star.dev/) syntax highlighting for [tempest/highlight](https://github.com/tempestphp/highlight) — highlights `data-*` attributes, `$signals`, `@actions`, and expressions in HTML code blocks.

## Installation

```bash
composer require mbolli/tempest-highlight-datastar
```

## Usage

### Register by name

Register the language once on your `Highlighter` instance, then use it by name:

```php
use Mbolli\TempestHighlightDatastar\Html\DatastarHtmlLanguage;
use Tempest\Highlight\Highlighter;

$highlighter = new Highlighter();
$highlighter->addLanguage(new DatastarHtmlLanguage());

// Use by name or alias
$html = $highlighter->parse($code, 'datastar-html');
$html = $highlighter->parse($code, 'datastar');
```

Registering the language also overrides the built-in `html` language (via alias), so `<<<HTML` heredocs in PHP code and Markdown fenced code blocks tagged ` ```html ` automatically get Datastar highlighting.

### Pass as object

Alternatively, pass the language directly without registering:

```php
$html = $highlighter->parse($code, new DatastarHtmlLanguage());
```

### What gets highlighted

- **Datastar `data-*` attributes** — `data-signals`, `data-on`, `data-bind`, `data-show`, etc.
- **Signals** — `$signalName`, `$$componentSignal`
- **Actions** — `@get()`, `@post()`, `@put()`, `@patch()`, `@delete()`, etc.
- **Special variables** — `el`, `evt`, `patch`
- **Expressions** inside attribute values are parsed as JavaScript with Datastar extensions

## Available Languages

| Class | Name | Alias | Extends |
|---|---|---|---|
| `DatastarHtmlLanguage` | `datastar-html` | `datastar`, `html` | `HtmlLanguage` |
| `DatastarTwigLanguage` | `datastar-twig` | `twig` | `DatastarHtmlLanguage` |

### Twig

```php
use Mbolli\TempestHighlightDatastar\Twig\DatastarTwigLanguage;

$highlighter->addLanguage(new DatastarTwigLanguage());
$html = $highlighter->parse($code, 'datastar-twig');
```

This also overrides the built-in `twig` language, so any code already highlighted as `'twig'` will gain Datastar support.

### PHP templates

Since `DatastarHtmlLanguage` overrides the built-in `html` language, just highlight your PHP files as `'php'`. The `PhpHeredocInjection` resolves `<<<HTML` blocks via the `'html'` name, which now points to `DatastarHtmlLanguage` — so heredocs and inline HTML automatically get Datastar highlighting.

### Markdown

Markdown in tempest/highlight does not parse inline HTML, so no Datastar-specific Markdown language is needed. Since `DatastarHtmlLanguage` overrides `html`, fenced code blocks tagged ` ```html `, ` ```datastar `, or ` ```datastar-html ` all get Datastar highlighting automatically.

### Creating your own language variant

tempest/highlight has no way to globally override `HtmlLanguage`, so languages like Blade that extend it won't automatically gain Datastar support. You can create your own variant by extending `DatastarHtmlLanguage` and re-adding the framework-specific injections/patterns.

For example, to create a Blade variant:

```php
use Mbolli\TempestHighlightDatastar\Html\DatastarHtmlLanguage;
use Tempest\Highlight\Languages\Blade\Injections\BladeEchoInjection;
use Tempest\Highlight\Languages\Blade\Injections\BladeKeywordInjection;
use Tempest\Highlight\Languages\Blade\Injections\BladePhpInjection;
use Tempest\Highlight\Languages\Blade\Injections\BladeRawEchoInjection;
use Tempest\Highlight\Languages\Blade\Patterns\BladeComponentCloseTagPattern;
use Tempest\Highlight\Languages\Blade\Patterns\BladeComponentOpenTagPattern;

final class DatastarBladeLanguage extends DatastarHtmlLanguage {
    #[\Override]
    public function getName(): string {
        return 'datastar-blade';
    }

    /** @return list<string> */
    #[\Override]
    public function getAliases(): array {
        return [];
    }

    #[\Override]
    public function getInjections(): array {
        return [
            ...parent::getInjections(),
            new BladeKeywordInjection(),
            new BladePhpInjection(),
            new BladeEchoInjection(),
            new BladeRawEchoInjection(),
        ];
    }

    #[\Override]
    public function getPatterns(): array {
        return [
            ...parent::getPatterns(),
            new BladeComponentOpenTagPattern(),
            new BladeComponentCloseTagPattern(),
        ];
    }
}
```

The pattern is always the same: extend `DatastarHtmlLanguage`, override `getName()`, and re-add the injections/patterns from the original language.

## License

MIT
