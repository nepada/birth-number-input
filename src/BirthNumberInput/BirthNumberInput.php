<?php
declare(strict_types = 1);

namespace Nepada\BirthNumberInput;

use Nepada\BirthNumber\BirthNumber;
use Nepada\BirthNumber\InvalidBirthNumberException;
use Nette\Forms\Controls\TextInput;
use Nette\Forms\Form;
use Nette\Forms\Validator as NetteFormsValidator;
use Nette\Utils\Html;
use Nette\Utils\Strings;

class BirthNumberInput extends TextInput
{

    public const VALID = Validator::class . '::validateBirthNumber';

    public function __construct(string|Html|null $label = null)
    {
        parent::__construct($label);
        $this->setNullable();
        $invalidValueErrorMessage = NetteFormsValidator::$messages[self::VALID] ?? 'Please enter a valid birth number.';
        $this->addRule(self::VALID, $invalidValueErrorMessage);
    }

    public function getValue(): ?BirthNumber
    {
        /** @var BirthNumber|null $value */
        $value = parent::getValue();
        return $value;
    }

    /**
     * @internal
     * @return $this
     */
    public function setValue(mixed $value): static
    {
        if (is_string($value)) {
            $value = BirthNumber::fromString($value);
        } elseif ($value !== null && ! $value instanceof BirthNumber) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Value must be null, BirthNumber instance, or string with a valid birth number, %s given in field "%s".',
                    gettype($value),
                    $this->name,
                ),
            );
        }

        parent::setValue($value);
        return $this;
    }

    /**
     * @param BirthNumber|string|null $value
     * @return $this
     */
    public function setDefaultValue(mixed $value): static
    {
        parent::setDefaultValue($value);
        return $this;
    }

    public function loadHttpData(): void
    {
        $value = $this->getHttpData(Form::DATA_LINE);

        if ($value === '' || $value === Strings::trim($this->translate($this->emptyValue))) {
            $this->value = null;
            $this->rawValue = $value;
            return;
        }

        try {
            $this->setValue($value);
        } catch (InvalidBirthNumberException $exception) {
            $this->value = null;
            $this->rawValue = $value;
        }
    }

    public function isFilled(): bool
    {
        return $this->rawValue !== '' && $this->rawValue !== Strings::trim($this->translate($this->emptyValue));
    }

}
