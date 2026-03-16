<?php

declare(strict_types=1);

namespace Mbolli\TempestHighlightDatastar\Twig;

use Mbolli\TempestHighlightDatastar\Html\DatastarHtmlLanguage;
use Tempest\Highlight\Languages\Twig\Injections\TwigEchoInjection;
use Tempest\Highlight\Languages\Twig\Injections\TwigTagInjection;
use Tempest\Highlight\Languages\Twig\Patterns\TwigCommentPattern;

/**
 * Extended Twig language with Datastar data-* attribute and expression highlighting.
 */
final class DatastarTwigLanguage extends DatastarHtmlLanguage {
    #[\Override]
    public function getName(): string {
        return 'datastar-twig';
    }

    /** @return list<string> */
    #[\Override]
    public function getAliases(): array {
        return ['twig'];
    }

    #[\Override]
    public function getInjections(): array {
        return [
            ...parent::getInjections(),
            new TwigTagInjection(),
            new TwigEchoInjection(),
        ];
    }

    #[\Override]
    public function getPatterns(): array {
        return [
            ...parent::getPatterns(),
            new TwigCommentPattern(),
        ];
    }
}
