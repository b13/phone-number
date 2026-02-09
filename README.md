# EXT:phone_number

Fluid ViewHelper for formatting phone numbers in TYPO3 using [libphonenumber](https://github.com/giggsey/libphonenumber-for-php-lite).

Formats raw phone numbers or `tel:` URIs (from TCA `type=link` with `allowedTypes=telephone`) into standardized international or national format (e.g. DIN 5008).

## Installation

```bash
composer req b13/phone-number
```

## Usage

Register the namespace in your Fluid template:

```html
<html
    data-namespace-typo3-fluid="true"
    xmlns:phone="http://typo3.org/ns/B13/PhoneNumber/ViewHelpers"
>
```

### International format (default)

```html
<phone:format value="tel:+497113400810" />
```
Output: `+49 711 3400810`

### National format

```html
<phone:format value="tel:+497113400810" national="1" />
```
Output: `0711 3400810`

### Raw number input

```html
<phone:format value="+49 (0) 711 34008-10" />
```
Output: `+49 711 3400810`

## ViewHelper Arguments

| Argument        | Type   | Default | Description                                                        |
|-----------------|--------|---------|--------------------------------------------------------------------|
| `value`         | string | —       | Phone number or `tel:` link value (required)                       |
| `defaultRegion` | string | `DE`    | Default region for parsing numbers without country code            |
| `national`      | bool   | `false` | Format as national number (0711 ...) instead of international      |

## Requirements

- PHP ^8.1
- TYPO3 ^12.4, ^13.4 or ^14.0

## License

GPL-2.0-or-later

## Credits

This extension was created by David Steeb in 2026 for [b13 GmbH, Stuttgart](https://b13.com).

Phone number parsing is powered by [libphonenumber-for-php-lite](https://github.com/giggsey/libphonenumber-for-php-lite).

[Find more TYPO3 extensions we have developed](https://b13.com/useful-typo3-extensions-from-b13-to-you) that help us deliver value in client projects. As part of our work, we focus on testing and best practices to ensure long-term performance, reliability, and results in all our code.
