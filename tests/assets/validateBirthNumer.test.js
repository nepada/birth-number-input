import {testInstances} from './bootstrap';

describe.each(testInstances)('%s', (name, Nette) => {
    document.body.innerHTML = '<form><input type="text" name="birthNumber"></form>';
    const form = document.forms[0];
    const input = form.elements[0];

    test('empty', () => {
        input.value = '';
        expect(Nette.validators.NepadaBirthNumberInputValidator_validateBirthNumber(input, [], input.value)).toBe(false);
    });

    test('garbage', () => {
        input.value = 'lorem ipsum';
        expect(Nette.validators.NepadaBirthNumberInputValidator_validateBirthNumber(input, [], input.value)).toBe(false);
    });

    test('invalid date', () => {
        input.value = '910229 / 0000';
        expect(Nette.validators.NepadaBirthNumberInputValidator_validateBirthNumber(input, [], input.value)).toBe(false);
    });

    test('+20 month modifier used before 2004', () => {
        input.value = '032101 / 0008';
        expect(Nette.validators.NepadaBirthNumberInputValidator_validateBirthNumber(input, [], input.value)).toBe(false);
    });

    test('+70 month modifier used before 2004', () => {
        input.value = '037101 / 0002';
        expect(Nette.validators.NepadaBirthNumberInputValidator_validateBirthNumber(input, [], input.value)).toBe(false);
    });

    test('missing checksum', () => {
        input.value = '540101 / 000';
        expect(Nette.validators.NepadaBirthNumberInputValidator_validateBirthNumber(input, [], input.value)).toBe(false);
    });

    test('invalid checksum', () => {
        input.value = '000101 / 0000';
        expect(Nette.validators.NepadaBirthNumberInputValidator_validateBirthNumber(input, [], input.value)).toBe(false);
        input.value = '000101 / 0001';
        expect(Nette.validators.NepadaBirthNumberInputValidator_validateBirthNumber(input, [], input.value)).toBe(false);
        input.value = '000101 / 0002';
        expect(Nette.validators.NepadaBirthNumberInputValidator_validateBirthNumber(input, [], input.value)).toBe(false);
        input.value = '000101 / 0003';
        expect(Nette.validators.NepadaBirthNumberInputValidator_validateBirthNumber(input, [], input.value)).toBe(false);
        input.value = '000101 / 0004';
        expect(Nette.validators.NepadaBirthNumberInputValidator_validateBirthNumber(input, [], input.value)).toBe(false);
        input.value = '000101 / 0005';
        expect(Nette.validators.NepadaBirthNumberInputValidator_validateBirthNumber(input, [], input.value)).toBe(false);
        input.value = '000101 / 0006';
        expect(Nette.validators.NepadaBirthNumberInputValidator_validateBirthNumber(input, [], input.value)).toBe(false);
        input.value = '000101 / 0007';
        expect(Nette.validators.NepadaBirthNumberInputValidator_validateBirthNumber(input, [], input.value)).toBe(false);
        input.value = '000101 / 0008';
        expect(Nette.validators.NepadaBirthNumberInputValidator_validateBirthNumber(input, [], input.value)).toBe(false);
        input.value = '000101 / 0011';
        expect(Nette.validators.NepadaBirthNumberInputValidator_validateBirthNumber(input, [], input.value)).toBe(false);
        input.value = '000101 / 0012';
        expect(Nette.validators.NepadaBirthNumberInputValidator_validateBirthNumber(input, [], input.value)).toBe(false);
        input.value = '000101 / 0013';
        expect(Nette.validators.NepadaBirthNumberInputValidator_validateBirthNumber(input, [], input.value)).toBe(false);
        input.value = '000101 / 0014';
        expect(Nette.validators.NepadaBirthNumberInputValidator_validateBirthNumber(input, [], input.value)).toBe(false);
        input.value = '000101 / 0015';
        expect(Nette.validators.NepadaBirthNumberInputValidator_validateBirthNumber(input, [], input.value)).toBe(false);
        input.value = '000101 / 0016';
        expect(Nette.validators.NepadaBirthNumberInputValidator_validateBirthNumber(input, [], input.value)).toBe(false);
        input.value = '000101 / 0017';
        expect(Nette.validators.NepadaBirthNumberInputValidator_validateBirthNumber(input, [], input.value)).toBe(false);
        input.value = '000101 / 0018';
        expect(Nette.validators.NepadaBirthNumberInputValidator_validateBirthNumber(input, [], input.value)).toBe(false);
        input.value = '000101 / 0019';
        expect(Nette.validators.NepadaBirthNumberInputValidator_validateBirthNumber(input, [], input.value)).toBe(false);
    });


    test('valid', () => {
        input.value = '531231123';
        expect(Nette.validators.NepadaBirthNumberInputValidator_validateBirthNumber(input, [], input.value)).toBe(true);
        input.value = '531231/1235';
        expect(Nette.validators.NepadaBirthNumberInputValidator_validateBirthNumber(input, [], input.value)).toBe(true);
        input.value = '900101   0007';
        expect(Nette.validators.NepadaBirthNumberInputValidator_validateBirthNumber(input, [], input.value)).toBe(true);
        input.value = '905101 / 0001';
        expect(Nette.validators.NepadaBirthNumberInputValidator_validateBirthNumber(input, [], input.value)).toBe(true);
        input.value = '042229   0000';
        expect(Nette.validators.NepadaBirthNumberInputValidator_validateBirthNumber(input, [], input.value)).toBe(true);
        input.value = '047229 / 0050';
        expect(Nette.validators.NepadaBirthNumberInputValidator_validateBirthNumber(input, [], input.value)).toBe(true);
    });
});
