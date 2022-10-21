(function (global, factory) {
    typeof exports === 'object' && typeof module !== 'undefined' ? factory(require('nette-forms')) :
    typeof define === 'function' && define.amd ? define(['nette-forms'], factory) :
    (global = typeof globalThis !== 'undefined' ? globalThis : global || self, factory(global.Nette));
})(this, (function (Nette) { 'use strict';

    var bindToNetteForms = (function (Nette) {
      Nette.validators.NepadaBirthNumberInputValidator_validateBirthNumber = function (element, argument, value) {
        if (typeof value !== 'string') {
          return false;
        }
        var match = value.match(/^[\t-\r \xA0\u1680\u2000-\u200A\u2028\u2029\u202F\u205F\u3000\uFEFF]*([0-9][0-9])([0-9][0-9])([0-9][0-9])[\t-\r \xA0\u1680\u2000-\u200A\u2028\u2029\u202F\u205F\u3000\uFEFF]*\/?[\t-\r \xA0\u1680\u2000-\u200A\u2028\u2029\u202F\u205F\u3000\uFEFF]*([0-9][0-9][0-9])([0-9]?)[\t-\r \xA0\u1680\u2000-\u200A\u2028\u2029\u202F\u205F\u3000\uFEFF]*$/);
        if (!match) {
          return false;
        }
        var yearPart = match[1];
        var monthPart = match[2];
        var dayPart = match[3];
        var extension = match[4];
        var checksum = match[5];
        var year = parseInt(yearPart, 10);
        var month = parseInt(monthPart, 10);
        var day = parseInt(dayPart, 10);
        year += 1900;
        if (year < 1954) {
          if (checksum !== '') {
            year += 100;
          }
        } else if (checksum === '') {
          return false;
        }
        if (checksum !== '') {
          var mod = parseInt(yearPart + monthPart + dayPart + extension, 10) % 11 % 10;
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
        var date = new Date(year, month - 1, day);
        return date.getFullYear() === year && date.getMonth() === month - 1 && date.getDate() === day;
      };
    });

    bindToNetteForms(Nette);

}));
//# sourceMappingURL=birth-number-input.js.map
