<?php
declare(strict_types = 1);

namespace Nepada\BirthNumberInput;

use Nepada\BirthNumber\BirthNumber;
use Nepada\BirthNumber\InvalidBirthNumberException;
use Nette;
use Nette\Forms\Control;

final class Validator
{

    use Nette\StaticClass;

    public static function validateBirthNumber(Control $control): bool
    {
        $value = self::castToBirthNumber($control->getValue());
        return $value instanceof BirthNumber;
    }

    private static function castToBirthNumber(mixed $value): ?BirthNumber
    {
        if ($value instanceof BirthNumber || $value === null) {
            return $value;
        }

        if (is_int($value)) {
            $value = (string) $value;
        } elseif (is_object($value) && method_exists($value, '__toString')) {
            $value = $value->__toString();
        }

        if (! is_string($value)) {
            return null;
        }

        try {
            return BirthNumber::fromString($value);
        } catch (InvalidBirthNumberException $exception) {
            return null;
        }
    }

}
