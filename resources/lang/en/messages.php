<?php

return [

    'success' => '',
    'error' => 'An error occured.',
    'info' => '',
    'authError' => 'You must be logged in to perform this action',
    'serverError' => 'Server error occurred',
    'accountActivated' => 'Your account has been verified!',

    'requirePremium' => 'The Premium account status is required',
    'requirePremium+' => 'The Premium+ account status is required',

    'postUploaded' => 'Post has been published successfully!',
    'postUploadedError' => 'Error occured while publishing the Post.',
    'postDeleted' => 'Post has been deleted successfully!',
    'postDeleteError' => 'Error occured while deleting the Post.',
    'postEdited' => 'Post has been changed successfully!',
    'postEditedError' => 'Error occured while editing the post.',
    'postAddedFav' => 'Post has been added to Favourites!',
    'postAddFavError' => 'An error occured.',
    'postAddFavPersonal' => 'Your oun post can not be added to Favourites.',
    'postRemovedFav' => 'Post has been deleted from Favourites successfully!',
    'postRemoveFavError' => 'An error occured.',
    'postEditedErrorTooManyImages' => 'Too many images, maximum 5.',
    'postNewImgsDeleted' => 'Images have been cleared',
    'postImgsDeleted' => 'Images have been deleted',
    'postImgDeleted' => 'Image have been deleted',
    'postInputErrors' => 'Some fields are incorrect.',
    'postActivated' => 'Post has been published again',
    'postDisactivated' => 'Post has been hidden from public',
    'postOutdated' => 'This Post is outdated, please update the lifetime in Post settings',
    'tooManyPostsError' => 'You have reached the maximum amount of posts. (200 for premium, 500 for Premium+)',

    'mailerToManyTags' => 'Too many categories',
    'mailerUploaded' => 'Mailer has been configured successfully!',
    'mailerUploadedError' => 'Error occured while configuring the Mailer.',
    'mailerDeleted' => 'Mailer has been deleted successfully!',
    'mailerEditedError' => 'Error occured while editing the Mailer.',
    'mailerEdited' => 'Mailer has been changed successfully!',
    'mailerAddedAuthor' => 'Author added to Mailer',
    'mailerTooManyAuthors' => 'You have reached the maximum number of Authors',
    'mailerRemovedAuthor' => 'Author removed from Mailer',
    'mailerAuthorExists' => 'Author already in Mailer',
    'mailerTagExists' => 'Specified categories already in your Mailer',
    'mailerTagAdded' => 'Specified categories added to your Mailer successfully!',
    'mailerTextAdded' => 'Specified keywords added to your Mailer successfully!',
    'tagAlreadyChosen' => 'You can not choose the same category twice!',
    'mailerRequestAdded' => 'The request has been added to Mailer successfully!',
    'mailerTooManyMailers' => 'Too many Mailers! (max. 10)',
    'mailerEmptyConditionsError' => 'At least one Condition required!',
    'mailerEmptyTypesError' => 'At least one Type required!',
    'mailerEmptyRolesError' => 'At least one Legal Type required!',
    'mailerEmptyThreadsError' => 'Please choose Equipment or Service',

    'profileEdited' => 'Profile has been changed successfully!',
    'profileImgDeleted' => 'Profile picture was deleted successfully!',

    'signedIn' => 'Welcome!',
    'signedOut' => 'Good bye',

    'messageSent' => 'The message has been sent!',
    
    'planAlreadyPremium+' => 'You already have free Premium+ Account!',
    'planCancelPremium+' => 'Sorry, you cannot cancel free Premium+ right now',
    
    'postImportError' => 'The error occurred while analyzing the import file',
    'postImportSuccess' => 'The post imported successfully',

    'importExtError' => 'Only xlsx files are allowed.',
    'importStuctureError' => 'The import file structure is broken.',
    'importEmptyError' => 'The uploaded file is empty.',
    'importCompulsoryError' => 'Compulsory fields are not filled.',
    'importThreadError' => '"Equipment/service" field is filled incorrectly.',
    'importTypeError' => '"Type" field is filled incorrectly.',
    'importRoleError' => '"Role" field is filled incorrectly.',
    'importConditionError' => '"Condition" field is filled incorrectly.',
    'importTagError' => '"Category" field is filled incorrectly.',
    'importCurrencyError' => '"Currency" field is filled incorrectly.',
    'importRegionError' => '"Region" field is filled incorrectly.',
    'importLifetimeError' => '"Lifetime" field is filled incorrectly.',
    'importTitleError' => '"Title" field is filled incorrectly.',
    'importAmountError' => '"Amount" field is filled incorrectly.',
    'importDescriptionError' => '"Description" field is filled incorrectly.',
    'importCompanyError' => '"Company" field is filled incorrectly.',
    'importManufError' => '"Manufacturer" field is filled incorrectly.',
    'importManufDateError' => '"Manufectired" date field is filled incorrectly.',
    'importPNError' => '"Part" number field is filled incorrectly.',
    'importCostError' => '"Cost" field is filled incorrectly.',
    'importCurrencyMError' => '"Currency" field is mandatory if cost is specified.',
    'importTownError' => '"Town" field is filled incorrectly.',
    'importEmailError' => '"Email" field is filled incorrectly.',
    'importPhoneError' => '"Phone" field is filled incorrectly.',
];

/*
return 'phone is incorrect in post #' . ($key+1) . '. Value = ['.$row[9].']';
return 'email is incorrect';
return 'town is incorrect';
return 'currency is mandatory if cost is cpecified is post #' . ($key+1);
return 'cost is incorrect';
return 'part number is incorrect. ' . $row[11];
return 'manufacturer date is incorrect. ' . $row[10];
return 'manufacturer is incorrect in post #' . ($key+1) . '. Value = ['.$row[9].']';
return 'company is incorrect. ' . $row[4];
return 'description is incorrect';
return 'title is incorrect in post #' . ($key+1) . '. Value = ['.$row[1].']';
return 'lifetime is incorrect';
return 'region is incorrect';
return 'currency is incorrect';
return 'category is incorrect in post #' . ($key+1) . '. Value = ['.$row[8].']';
return 'condition is incorrect in post #' . ($key+1) . '. Value = ['.$row[7].']';
return 'role is incorrect';
return 'type is incorrect';
return 'thread is incorrect';
return ' in post #' . ($key+1);
*/
