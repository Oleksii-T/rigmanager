<?php

return [
    'intro' => 'Rules for filling the file for bulk post import',
    'mainRulesTitle' => 'General rules',
    'mainRules1' => 'Changing the file structure makes automatic import impossible. Those. adding / removing columns / pages, swapping or moving already created cells is highly discouraged.',
    'mainRules2' => 'Filling out the form is allowed on cells A3:W502',
    'mainRules3' => 'The form is designed to import from 1 to 500 posts.',
    'mainRules4' => 'Each line is a separate post.',
    'mainRules5' => 'The first announcement should be placed in cells A3:W3.',
    'mainRules6' => 'The form will be accepted only upon compliance with all the rules in all posts.',
    'mainRules7' => 'The algorithm analyzes the shape line by line; if an error is found, the analysis will be stopped.',
    'mainRules8' => 'After importing the form, you will be told in which declaration the error was found.',
    'mainRules9' => 'The form must be completed in one language (Rus / Ukr / Eng).',
    'mainRules10' => 'You can add images, set the "Urgent" status and change the auto-translation for each ad manually through the ad edit page on the site.',
    'detailedRules' => 'Detailed instructions for filling in each field.',
    'required' => 'Required',
    'titleRule' => 'Enter the name of the equipment / part / service.
        Should not contain words and synonyms: sell, buy, rent, rent, urgently, checked, rigmanager.
        Should not contain: telephone, email, link, words in capital letters (except for abbreviations).
        Minimum 10 characters.
        Maximum 70 characters.',
    'descRule' => 'Please describe your equipment / part / service in as much detail as possible.
        Should apply to all information provided on row (post).
        Should not contain: telephone, email, link, words in capital letters (except for abbreviations).
        Minimum 10 characters.
        Maximum 9000 characters.',
    'threadRule' => 'Only certain values ​​are allowed for entry:
        1 - Equipment
        2 - Service',
    'companyRule' => 'If you entered the value "2" in "Sector", you can enter the company name here.
        Minimum 5 characters.
        Maximum 200 characters.',
    'type' => 'Type',
    'typeRule' => 'Only certain values ​​are allowed for input:
        1 - Equipment sale
        2 - Equipment purchase
        3 - Equipment rent
        4 - Equipment lease
        5 - Service provision
        6 - Service request',
    'roleRule' => 'Only certain values ​​are allowed for input:
        1 - Private person
        2 - Business',
    'conditionRule' => 'Only certain values ​​are allowed for input:
        1 - New
        2 - Used
        3 - For spare parts',
    'tag' => 'Category',
    'tagRule' => 'Tag must be one of available tag-code, click the button below to see the full list of available codes.
        The chosen tag must comply with chosen "Equipment / service" field.',
    'tagRuleEqBtn' => 'See list of equipment category codes',
    'tagRuleSeBtn' => 'See list of service category codes',
    'manufManufDatePN' => 'Manufacturer. Date of manufacture. Part number',
    'manufManufDatePNRule' => 'We advise adding Manufacturer, Manufacturing Date and Factory Item Number to make it easier for customers to find and understand your proposal.
        Minimum 5 for manufacturer, 4 for manufacturing date, 3 for p/n characters.
        Maximum 70 characters.',
    'currency' => 'Currency',
    'currencyRule' => 'Only certain values ​​are allowed for input:
        UAH - Hryvnia
        USD - Dollar',
    'regionRule' => 'Region must be one of region-code, click the button below to see the full list of available codes.',
    'regionRuleBtn' => 'See list of region codes',
    'emailRule' => 'Mail is not required if a contact phone number has been entered.
        You can enter any email address.
        Max lenght: 254',
    'phoneRule' => 'A phone number is not required if a contact email has been entered.
        You can enter any phone number.
        Only phone numbers of Ukraine are considered valid
        Phone format: 
        0 (12) 345 67 89',
    'VTW' => 'Have Viber / Telegram / Whatsapp',
    'VTWRule' => 'Leave the field blank if you are not using this application, or enter any character if you are.',
    'lifetime' => 'Live period',
    'lifetimeRule' => 'Only certain values ​​are allowed for input:
        1 - 1 month
        2 - 2 months
        3 - Unlimited (Available for Premium+ accounts)',
];