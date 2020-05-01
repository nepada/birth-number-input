<?php
declare(strict_types = 1);

namespace NepadaTests\Bridges\BirthNumberInputForms;

use Nepada\BirthNumberInput\BirthNumberInput;
use NepadaTests\TestCase;
use Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';


/**
 * @testCase
 */
class BirthNumberInputMixinTest extends TestCase
{

    public function testAddBirthNumber(): void
    {
        $form = new TestForm();
        $input = $form->addBirthNumber('test', 'Label');
        Assert::type(BirthNumberInput::class, $input);
        Assert::same('Label', $input->caption);
        Assert::same($input, $form['test']);
    }

}

(new BirthNumberInputMixinTest())->run();
