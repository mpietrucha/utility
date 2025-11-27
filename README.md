# Utility

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mpietrucha/utility.svg?style=flat-square)](https://packagist.org/packages/mpietrucha/utility)
[![Total Downloads](https://img.shields.io/packagist/dt/mpietrucha/utility.svg?style=flat-square)](https://packagist.org/packages/mpietrucha/utility)

A modern PHP 8.5 utility library providing enhanced versions of Laravel's core components (Arr, Str, Collection), advanced file system operations with intelligent caching, PSR-7 stream handling, runtime class forking capabilities, comprehensive type checking, dot-notation data access, PHP tokenization, Composer introspection, powerful method forwarding, and custom PHPStan extensions for static analysis - all with PHPStan Level 8 type safety.

## Installation

```bash
composer require mpietrucha/utility
```

**Requirements:** PHP 8.5 or higher

## Testing

```bash
composer test        # Run linting and type checking
composer lint        # Fix code style with Laravel Pint
composer test:lint   # Check code style
composer test:types  # Run PHPStan static analysis (Level 8)
```

## License

MIT
