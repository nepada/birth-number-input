Czech birth number form input
=============================

[![Build Status](https://github.com/nepada/birth-number-input/workflows/CI/badge.svg)](https://github.com/nepada/birth-number-input/actions?query=workflow%3ACI+branch%3Amaster)
[![Coverage Status](https://coveralls.io/repos/github/nepada/birth-number-input/badge.svg?branch=master)](https://coveralls.io/github/nepada/birth-number-input?branch=master)
[![Downloads this Month](https://img.shields.io/packagist/dm/nepada/birth-number-input.svg)](https://packagist.org/packages/nepada/birth-number-input)
[![Latest stable](https://img.shields.io/packagist/v/nepada/birth-number-input.svg)](https://packagist.org/packages/nepada/birth-number-input)


Installation
------------

Via Composer:

```sh
$ composer require nepada/birth-number-input
```

### Option A: install form container extension method via DI extension

```yaml
extensions:
    - Nepada\Bridges\BirthNumberInputDI\BirthNumberInputExtension
```

It will register extension method `addBirthNumber($name, $label = null): BirthNumberInput` to `Nette\Forms\Container`.


### Option B: use trait in your base form/container class

You can also use `BirthNumberInputMixin` trait in your base form/container class to add method `addBirthNumber($name, $label = null): BirthNumberInput`.

Example:

```php

trait FormControls
{

    use Nepada\Bridges\BirthNumberInputForms\BirthNumberInputMixin;

    public function addContainer($name)
    {
        $control = new Container;
        $control->setCurrentGroup($this->getCurrentGroup());
        if ($this->currentGroup !== null) {
            $this->currentGroup->add($control);
        }
        return $this[$name] = $control;
    }

}

class Container extends Nette\Forms\Container
{

    use FormControls;

}

class Form extends Nette\Forms\Form
{

    use FormControls;

}

``` 


Usage
-----

`BirthNumberInput` is form control that uses birth number value object to represent its value (see [nepada/birth-number](https://github.com/nepada/birth-number) for further details).
It automatically validates the user input and `getValue()` method always returns `BirthNumber` instance, or `null` if the input is not filled.

```php
$birthNumberInput = $form->addBirthNumber('birthNumber');
$birthNumberInput->setValue('invalid'); // \InvalidArgumentException is thrown
$birthNumberInput->setValue('000101 / 0009'); // the value is internally converted to BirthNumber value object
$birthNumberInput->getValue(); // BirthNumber instance for 000101/0009
```


### Client side validation

#### Using precompiled bundle

Using precompiled bundles is the quick'n'dirty way of getting client side validation to work.

```html
<script src="https://unpkg.com/nette-forms@%5E3.0/src/assets/netteForms.min.js"></script>
<script src="https://unpkg.com/@nepada/birth-number-input@%5E1.0/dist/birth-number-input.min.js"></script>
```

#### Building your own bundle

It is highly recommended to install the client side package via nmp and compile your own bundle.

Here is an example script for initialization of birth number input and Nette forms.  

```js
import Nette from 'nette-forms';
import initializeBirthNumberInput from '@nepada/birth-number-input';

initializeBirthNumberInput(Nette);
Nette.initOnLoad();

```
