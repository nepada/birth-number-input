<?php
declare(strict_types = 1);

namespace NepadaTests\BirthNumberInput;

use Mockery\MockInterface;
use Nepada\BirthNumber\BirthNumber;
use Nepada\BirthNumberInput\Validator;
use NepadaTests\TestCase;
use Nette\Forms\Control;
use Nette\Utils\Html;
use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';


/**
 * @testCase
 */
class ValidatorTest extends TestCase
{

    /**
     * @dataProvider getDataForValidateBirthNumber
     */
    public function testValidateBirthNumber(mixed $value, bool $isValid): void
    {
        $control = $this->mockControl($value);
        Assert::same($isValid, Validator::validateBirthNumber($control));
    }

    /**
     * @return list<mixed[]>
     */
    protected function getDataForValidateBirthNumber(): array
    {
        return [
            [
                'value' => 3.14,
                'isValid' => false,
            ],
            [
                'value' => null,
                'isValid' => false,
            ],
            [
                'value' => '',
                'isValid' => false,
            ],
            [
                'value' => '000101 / 0008',
                'isValid' => false,
            ],
            [
                'value' => '000101 / 0009',
                'isValid' => true,
            ],
            [
                'value' => Html::el()->setText('000101 / 0009'),
                'isValid' => true,
            ],
            [
                'value' => BirthNumber::fromString('000101 / 0009'),
                'isValid' => true,
            ],
        ];
    }

    /**
     * @return Control&MockInterface
     */
    private function mockControl(mixed $value): Control
    {
        $control = \Mockery::mock(Control::class);
        $control->shouldReceive('getValue')->andReturn($value);
        return $control;
    }

}


(new ValidatorTest())->run();
