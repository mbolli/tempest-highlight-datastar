<?php

declare(strict_types=1);

namespace Mbolli\TempestHighlightDatastar\Expression;

use Mbolli\TempestHighlightDatastar\Expression\Patterns\DatastarActionPattern;
use Mbolli\TempestHighlightDatastar\Expression\Patterns\DatastarSignalPattern;
use Tempest\Highlight\Languages\JavaScript\JavaScriptLanguage;

/**
 * JavaScript language extended with Datastar-specific tokens.
 * Used only for parsing Datastar attribute expression values.
 */
final class DatastarExpressionLanguage extends JavaScriptLanguage {
    #[\Override]
    public function getName(): string {
        return 'datastar-expression';
    }

    #[\Override]
    public function getPatterns(): array {
        return [
            new DatastarSignalPattern(),
            new DatastarActionPattern(),
            ...parent::getPatterns(),
        ];
    }
}
