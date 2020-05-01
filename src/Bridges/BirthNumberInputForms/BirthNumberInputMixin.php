<?php
declare(strict_types = 1);

namespace Nepada\Bridges\BirthNumberInputForms;

use Nepada\BirthNumberInput\BirthNumberInput;
use Nette\Utils\Html;

trait BirthNumberInputMixin
{

    /**
     * @param string|int $name
     * @param string|Html|null $label
     * @return BirthNumberInput
     */
    public function addBirthNumber($name, $label = null): BirthNumberInput
    {
        return $this[$name] = new BirthNumberInput($label);
    }

}
