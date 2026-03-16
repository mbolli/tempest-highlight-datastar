<?php

declare(strict_types=1);

namespace Mbolli\TempestHighlightDatastar\Expression\Patterns;

use Tempest\Highlight\IsPattern;
use Tempest\Highlight\Pattern;
use Tempest\Highlight\Tokens\TokenTypeEnum;

/**
 * Highlights Datastar signal references and special variables in expressions.
 *
 * Matches:
 *   $signalName     — global signals
 *   $$componentSig  — component-scoped signals
 *   el              — the element the attribute is attached to
 *   evt             — the event object (data-on:* expressions)
 */
final class DatastarSignalPattern implements Pattern {
    use IsPattern;

    public function getPattern(): string {
        return '(?<match>\$\$?[a-zA-Z_]\w*|\bel\b|\bevt\b)';
    }

    public function getTokenType(): TokenTypeEnum {
        return TokenTypeEnum::VARIABLE;
    }
}
