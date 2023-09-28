<?php
declare(strict_types = 1);

namespace Nepada\Bridges\BirthNumberInputForms;

use Nepada\BirthNumberInput\BirthNumberInput;
use Nette\Utils\Html;

trait BirthNumberInputMixin
{

    public function addBirthNumber(string|int $name, string|Html|null $label = null): BirthNumberInput
    {
        return $this[$name] = new BirthNumberInput($label);
    }

}
