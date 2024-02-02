<?php
declare(strict_types = 1);

namespace Nepada\Bridges\BirthNumberInputForms;

use Nepada\BirthNumberInput\BirthNumberInput;
use Nette;
use Nette\Forms\Container;
use Nette\Utils\Html;

class ExtensionMethodRegistrator
{

    use Nette\StaticClass;

    public static function register(): void
    {
        Container::extensionMethod(
            'addBirthNumber',
            fn (Container $container, string|int $name, string|Html|null $label = null): BirthNumberInput => $container[(string) $name] = new BirthNumberInput($label),
        );
    }

}
