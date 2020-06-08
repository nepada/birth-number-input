<?php
declare(strict_types = 1);

namespace NepadaTests\Bridges\BirthNumberInputDI;

use Nepada\BirthNumberInput\BirthNumberInput;
use NepadaTests\Environment;
use NepadaTests\TestCase;
use Nette;
use Nette\Forms\Form;
use Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';


/**
 * @testCase
 */
class BirthNumberInputExtensionTest extends TestCase
{

    public function testBirthNumberInput(): void
    {
        $configurator = new Nette\Configurator();
        $configurator->setTempDirectory(Environment::getTempDir());
        $configurator->setDebugMode(true);
        $configurator->addConfig(__DIR__ . '/fixtures/config.neon');
        $configurator->createContainer();

        $form = new Form();
        $input = $form->addBirthNumber('test', 'Label');
        Assert::type(BirthNumberInput::class, $input);
        Assert::same('Label', $input->caption);
        Assert::same($input, $form['test']);
    }

}


(new BirthNumberInputExtensionTest())->run();
