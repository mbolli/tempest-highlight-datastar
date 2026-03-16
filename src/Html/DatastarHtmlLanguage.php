<?php

declare(strict_types=1);

namespace Mbolli\TempestHighlightDatastar\Html;

use Mbolli\TempestHighlightDatastar\Html\Injections\DatastarExpressionInjection;
use Mbolli\TempestHighlightDatastar\Html\Patterns\DatastarAttributePattern;
use Tempest\Highlight\Languages\Html\HtmlLanguage;

/**
 * Extended HTML language with Datastar data-* attribute and expression highlighting.
 */
class DatastarHtmlLanguage extends HtmlLanguage {
    #[\Override]
    public function getName(): string {
        return 'datastar-html';
    }

    /** @return list<string> */
    #[\Override]
    public function getAliases(): array {
        return ['datastar', 'html'];
    }

    #[\Override]
    public function getPatterns(): array {
        return [
            new DatastarAttributePattern(),
            ...parent::getPatterns(),
        ];
    }

    #[\Override]
    public function getInjections(): array {
        return [
            new DatastarExpressionInjection(),
            ...parent::getInjections(),
        ];
    }
}
