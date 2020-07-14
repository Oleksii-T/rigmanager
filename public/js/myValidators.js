/**
 * Add jQuery Validation plugin method for a valid password
 * 
 * Valid passwords contain at least one letter and one number.
 */
$.validator.addMethod('validPasswordOld',
    function(value, element, param) {

        if (value != '') {
            if (value.match(/.*[a-z]+.*/i) == null) {
                return false;
            }
            if (value.match(/.*\d+.*/) == null) {
                return false;
            }
        }

        return true;
    },
    'Минимум одна цифра и одна буква'
);

/**
 * Add jQuery Validation plugin method for a valid password
 * 
 * Valid passwords contain at least one small and big letter and one number.
 */
$.validator.addMethod('validPassword',
    function(value, element, param) {

        if (value != '') {
            if (value.match(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/) == null) {
                return false;
            }
        }
        return true;
    },
    'Минимум одна цыфа, бол. и мал. буква'
);

/**
 * Add jQuery Validation plugin method for a valid password
 * 
 * Valid name contains small/big letters and numbers.
 */
$.validator.addMethod('validName',
    function(value, element, param) {

        if (value != '') {
            if (value.match(/^[(\x7F-\xFF)|(\s)|(a-z)|(A-Z)|(1-9)]*$/) == null) {
                return false;
            }
        }

        return true;
    },
    'Только буквы и цыфры'
);

/**
 * Add jQuery Validation plugin method for a valid password
 * 
 * Valid phone form.
 */
$.validator.addMethod('validPhone',
    function(value, element, param) {

        if (value != '') {
            if (value.match(/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\./0-9]*$/) == null) {
                return false;
            }
        }

        return true;
    },
    'Не верный номер телефона'
);