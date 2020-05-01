<?php
declare(strict_types = 1);

namespace Nepada\Bridges\BirthNumberInputForms;

use Nepada\BirthNumberInput\BirthNumberInput;
use Nette;
use Nette\Forms\Container;

class ExtensionMethodRegistrator
{

    use Nette\StaticClass;

    public static function register(): void
    {
        Container::extensionMethod(
            'addBirthNumber',
            fn (Container $container, $name, $label = null): BirthNumberInput => $container[$name] = new BirthNumberInput($label),
        );
    }

}
