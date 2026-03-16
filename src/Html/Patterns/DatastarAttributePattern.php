<?php

declare(strict_types=1);

namespace Mbolli\TempestHighlightDatastar\Html\Patterns;

use Tempest\Highlight\IsPattern;
use Tempest\Highlight\Pattern;
use Tempest\Highlight\Tokens\TokenTypeEnum;

/**
 * Highlights Datastar data-* attributes in HTML code blocks.
 */
final class DatastarAttributePattern implements Pattern {
    use IsPattern;

    public function getPattern(): string {
        $bases = implode('|', [
            'animate',
            'attr',
            'bind',
            'class',
            'computed',
            'custom-validity',
            'effect',
            'else(?:-if)?',
            'for',
            'if',
            'ignore(?:-morph)?',
            'import',
            'indicator',
            'init',
            'json-signals',
            'key',
            'match-media',
            'on(?:-(?:intersect|interval|raf|resize|signal-patch(?:-filter)?))?',
            'persist',
            'preserve-attr',
            'prop',
            'query-string',
            'ref',
            'replace-url',
            'rocket',
            'schema',
            'scroll-into-view',
            'shadow-(?:closed|open)',
            'show',
            'signals',
            'static',
            'style',
            'text',
            'view-transition',
        ]);

        return '(?<match>data-(?:' . $bases . ')(?::[\w.@$:-]+)?(?:__[\w.]+)*)(?=[\s\/>="\'=]|$)';
    }

    public function getTokenType(): TokenTypeEnum {
        return TokenTypeEnum::ATTRIBUTE;
    }
}
