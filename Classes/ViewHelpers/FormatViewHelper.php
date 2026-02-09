<?php

/*
 * This file is part of TYPO3 CMS-based extension "phone_number" by b13.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 */

declare(strict_types=1);

namespace B13\PhoneNumber\ViewHelpers;

use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberUtil;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Formats a phone number for display using Google's libphonenumber.
 *
 * Accepts raw numbers, tel: URIs (from TCA type "link" with allowedTypes telephone),
 * or any parseable phone number string.
 *
 * Examples:
 *   <phone:format value="tel:+497113400810" />           → +49 711 3400810
 *   <phone:format value="tel:+497113400810" national="1" /> → 0711 3400810
 *   <phone:format value="+49 (0) 711 34008-10" />        → +49 711 3400810
 */
class FormatViewHelper extends AbstractViewHelper
{
    public function initializeArguments(): void
    {
        $this->registerArgument('value', 'string', 'Phone number or tel: link value', true);
        $this->registerArgument('defaultRegion', 'string', 'Default region for parsing numbers without country code', false, 'DE');
        $this->registerArgument('national', 'bool', 'Format as national number (0711 ...) instead of international (+49 711 ...)', false, false);
    }

    public function render(): string
    {
        $value = trim((string)$this->arguments['value']);
        if (str_starts_with($value, 'tel:')) {
            $value = substr($value, 4);
        }
        if ($value === '') {
            return '';
        }

        $phoneUtil = PhoneNumberUtil::getInstance();
        try {
            $number = $phoneUtil->parse($value, $this->arguments['defaultRegion']);
            $format = $this->arguments['national']
                ? PhoneNumberFormat::NATIONAL
                : PhoneNumberFormat::INTERNATIONAL;
            return $phoneUtil->format($number, $format);
        } catch (NumberParseException) {
            // If parsing fails, return the raw value without tel: prefix
            return $value;
        }
    }
}
