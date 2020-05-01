import {testInstances} from './bootstrap';

describe.each(testInstances)('%s', (name1, Nette1) => {
    describe.each(testInstances)('%s', (name2, Nette2) => {
        if (name1 === name2) {
            return;
        }

        test('validateBirthNumber', () => {
            expect(Nette1.validators.NepadaBirthNumberInputValidator_validateBirthNumber).toBeDefined();
            expect(Nette1.validators.NepadaBirthNumberInputValidator_validateBirthNumber)
                .not.toBe(Nette2.validators.NepadaBirthNumberInputValidator_validateBirthNumber);
        });
    });
});
