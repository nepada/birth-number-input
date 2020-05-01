<?php
declare(strict_types = 1);

namespace NepadaTests\BirthNumberInput;

use Nepada\BirthNumber\BirthNumber;
use Nepada\BirthNumber\InvalidBirthNumberException;
use Nepada\BirthNumberInput\BirthNumberInput;
use NepadaTests\TestCase;
use Nette\Forms\Form;
use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';


/**
 * @testCase
 */
class BirthNumberInputTest extends TestCase
{

    public function testSetNullValue(): void
    {
        $input = new BirthNumberInput();
        $input->setValue(null);
        Assert::null($input->getValue());
    }

    public function testSetBirthNumberValue(): void
    {
        $birthNumber = BirthNumber::fromString('000101/0009');
        $input = new BirthNumberInput();
        $input->setValue($birthNumber);
        Assert::type(BirthNumber::class, $input->getValue());
        Assert::same((string) $birthNumber, (string) $input->getValue());
    }

    public function testSetValidStringValue(): void
    {
        $birthNumber = '000101/0009';
        $input = new BirthNumberInput();
        $input->setValue($birthNumber);
        Assert::type(BirthNumber::class, $input->getValue());
        Assert::same($birthNumber, (string) $input->getValue());
    }

    public function testSetInvalidStringValue(): void
    {
        $input = new BirthNumberInput();
        Assert::exception(
            function () use ($input): void {
                $input->setValue('000101/0000');
            },
            InvalidBirthNumberException::class,
        );
    }

    public function testSetInvalidValue(): void
    {
        $input = new BirthNumberInput();
        Assert::exception(
            function () use ($input): void {
                $input->setValue(42);
            },
            \InvalidArgumentException::class,
        );
    }

    public function testNoDataSubmitted(): void
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_FILES = [];
        $_POST = ['birthNumber' => ''];

        $form = new Form();
        $birthNumberInput = new BirthNumberInput();
        $form['birthNumber'] = $birthNumberInput;
        $form->fireEvents();

        Assert::null($birthNumberInput->getValue());
        Assert::same(null, $birthNumberInput->getError());
        Assert::same(
            '<input type="text" name="birthNumber" id="frm-birthNumber" '
            . 'data-nette-rules=\'['
            . '{"op":"Nepada\\\\BirthNumberInput\\\\Validator::validateBirthNumber","msg":"Please enter a valid birth number."}]\'>',
            (string) $birthNumberInput->getControl(),
        );
    }

    public function testEmptyValueSubmitted(): void
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_FILES = [];
        $_POST = ['birthNumber' => '/'];

        $form = new Form();
        $birthNumberInput = new BirthNumberInput();
        $form['birthNumber'] = $birthNumberInput;
        $birthNumberInput->setEmptyValue('/');
        $form->fireEvents();

        Assert::null($birthNumberInput->getValue());
        Assert::same(null, $birthNumberInput->getError());
        Assert::same(
            '<input type="text" name="birthNumber" id="frm-birthNumber" '
            . 'data-nette-rules=\'['
            . '{"op":"Nepada\\\\BirthNumberInput\\\\Validator::validateBirthNumber","msg":"Please enter a valid birth number."}]\' data-nette-empty-value="/" value="/">',
            (string) $birthNumberInput->getControl(),
        );
    }

    public function testValidDataSubmitted(): void
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_FILES = [];
        $_POST = ['birthNumber' => '000101 / 0009'];

        $form = new Form();
        $birthNumberInput = new BirthNumberInput();
        $form['birthNumber'] = $birthNumberInput;
        $form->fireEvents();

        Assert::type(BirthNumber::class, $birthNumberInput->getValue());
        Assert::same('000101/0009', (string) $birthNumberInput->getValue());
        Assert::same(null, $birthNumberInput->getError());
        Assert::same(
            '<input type="text" name="birthNumber" id="frm-birthNumber" '
            . 'data-nette-rules=\'['
            . '{"op":"Nepada\\\\BirthNumberInput\\\\Validator::validateBirthNumber","msg":"Please enter a valid birth number."}]\' value="000101/0009">',
            (string) $birthNumberInput->getControl(),
        );
    }

    public function testInvalidDataSubmitted(): void
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_FILES = [];
        $_POST = ['birthNumber' => '000101 / 0000'];

        $form = new Form();
        $birthNumberInput = new BirthNumberInput();
        $form['birthNumber'] = $birthNumberInput;
        $birthNumberInput->setRequired('true');
        $form->fireEvents();

        Assert::null($birthNumberInput->getValue());
        Assert::same('Please enter a valid birth number.', $birthNumberInput->getError());
        Assert::same(
            '<input type="text" name="birthNumber" id="frm-birthNumber" required '
            . 'data-nette-rules=\'[{"op":":filled","msg":"true"},{"op":"Nepada\\\\BirthNumberInput\\\\Validator::validateBirthNumber","msg":"Please enter a valid birth number."}]\' value="000101 / 0000">',
            (string) $birthNumberInput->getControl(),
        );
    }

}


(new BirthNumberInputTest())->run();
