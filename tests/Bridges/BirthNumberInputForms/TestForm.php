<?php
declare(strict_types = 1);

namespace NepadaTests\Bridges\BirthNumberInputForms;

use Nepada\Bridges\BirthNumberInputForms\BirthNumberInputMixin;
use Nette;

class TestForm extends Nette\Forms\Form
{

    use BirthNumberInputMixin;

}
