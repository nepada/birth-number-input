export default (Nette) => {
    Nette.validators.NepadaBirthNumberInputValidator_validateBirthNumber = (element, argument, value) => {
        if (typeof value !== 'string') {
            return false;
        }

        const match = value.match(/^\s*(\d\d)(\d\d)(\d\d)\s*\/?\s*(\d\d\d)(\d?)\s*$/u);
        if (!match) {
            return false;
        }

        const yearPart = match[1];
        const monthPart = match[2];
        const dayPart = match[3];
        const extension = match[4];
        const checksum = match[5];

        let year = parseInt(yearPart, 10);
        let month = parseInt(monthPart, 10);
        let day = parseInt(dayPart, 10);

        year += 1900;
        if (year < 1954) {
            if (checksum !== '') {
                year += 100;
            }
        } else if (checksum === '') {
            return false;
        }

        if (checksum !== '') {
            const mod = (parseInt(yearPart + monthPart + dayPart + extension, 10) % 11) % 10;
            if (mod !== parseInt(checksum, 10)) {
                return false;
            }
        }

        if (month > 50) {
            month -= 50;
        }
        if (month > 20 && year > 2003) {
            month -= 20;
        }

        const date = new Date(year, month - 1, day);
        return date.getFullYear() === year && date.getMonth() === month - 1 && date.getDate() === day;
    };
};
