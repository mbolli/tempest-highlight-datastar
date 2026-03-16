# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/), and this project adheres to [Semantic Versioning](https://semver.org/).

## [1.0.0] - 2026-03-16

### Added

- `DatastarHtmlLanguage` — extended HTML language with Datastar attribute and expression highlighting
- `DatastarTwigLanguage` — extended Twig language with Datastar support
- `DatastarExpressionLanguage` — extended JavaScript language with Datastar signal and action tokens
- `DatastarAttributePattern` — highlights all Datastar `data-*` attributes including Pro and Rocket attributes
- `DatastarExpressionInjection` — re-parses attribute values as JavaScript expressions with Datastar extensions
- `DatastarActionPattern` — highlights `@get()`, `@post()`, `@put()`, `@patch()`, `@delete()`, and other actions
- `DatastarSignalPattern` — highlights `$signal`, `$$componentSignal`, `el`, `evt`
- Language registration support via `getName()` (`datastar-html`, `datastar-twig`, `datastar-expression`) and alias (`datastar`)
- `DatastarHtmlLanguage` overrides built-in `html` language when registered, enabling Datastar highlighting in `<<<HTML` heredocs and Markdown fenced code blocks
- `DatastarTwigLanguage` overrides built-in `twig` language when registered
