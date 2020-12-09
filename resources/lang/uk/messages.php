<?php

return [

    'success' => '',
    'error' => 'Виникла помилка.',
    'info' => '',
    'authError' => 'Ви повинні увійти в систему, щоб зробити цю дію',
    'serverError' => 'Сталася помилка сервера',
    'accountActivated' => 'Ваш обліковий запис був підтверджений!',

    'requirePremium' => 'Потрібен Преміум аккаунт',
    'requirePremium+' => 'Потрібен Преміум+ аккаунт',

    'postUploaded' => 'Оголошення додано успішно!',
    'postUploadedError' => 'При публікації оголошення виникла помилка.',
    'postDeleted' => 'Оголошення було видалено успішно!',
    'postDeleteError' => 'При видаленні оголошення виникла помилка.',
    'postEdited' => 'Оголошення було змінено успішно!',
    'postEditedError' => 'При зміні оголошення виникла помилка.',
    'postAddedFav' => 'Додано в Обране!',
    'postAddFavError' => 'Виникла помилка.',
    'postAddFavPersonal' => 'Своє оголошення не можна додати до Обраного',
    'postRemovedFav' => 'Видалено з Обраного!',
    'postRemoveFavError' => 'Виникла помилка.',
    'postEditedErrorTooManyImages' => 'Занадто багато зображень, максимум 5.',
    'postNewImgsDeleted' => 'Зображення були видалені',
    'postImgsDeleted' => 'Зображення були видалені',
    'postImgDeleted' => 'Зображення було видалено',
    'postInputErrors' => 'Деякі поля заповнені неправильно.',
    'postActivated' => 'Оголошення було опубліковано знову',
    'postDisactivated' => 'Оголошення було приховано від публіки',
    'postOutdated' => 'Це оголошення застаріло, будь ласка, поновіть період життя в налаштуваннях оголошення',
    'tooManyPostsError' => 'Ви досягли максимальної кількості оголошень. (200 для Преміум, 500 для Преміум+)',
    
    'mailerRequestAdded' => 'Запит успішно додано до Розсилку!',
    'mailerTooManyMailers' => 'Забагато Розсилок! (макс. 10)',
    'mailerToManyTags' => 'Занадто багато категорій',
    'mailerUploaded' => 'Розсилка налаштована успішно!',
    'mailerUploadedError' => 'При налаштуванні Розсилки сталася помилка.',
    'mailerDeleted' => 'Розсилка була видалена успішно!',
    'mailerEditedError' => 'При зміні Розсилки виникла помилка.',
    'mailerEdited' => 'Розсилка була змінена успішно!',
    'mailerAddedAuthor' => 'Автор був доданий в Розсилку успішно!',
    'mailerTooManyAuthors' => 'Ви досягли максимуму за кількістю Авторів',
    'mailerRemovedAuthor' => 'Автор був видалений з Розсилки успішно!',
    'mailerAuthorExists' => 'Автор вже знаходиться в Розсилці',
    'mailerTagExists' => 'Вказані категорії, вже є у вашій Розсилці',
    'mailerTagAdded' => 'Вказані категорії успішно додані в Вашу Розсилку!',
    'mailerTextAdded' => 'Зазначений запрос успішно доданий у Вашу Розсилку!',
    'tagAlreadyChosen' => 'Ви не можете вибрати одну і ту ж категорію двічі!',
    'MailerEmptyConditionsError' => 'Необхідно вибрати хоча б один Стан!',
    'MailerEmptyTypesError' => 'Необхідно вибрати хоча б один Тип!',
    'MailerEmptyRolesError' => 'Необхідно вибрати хоча б один Сектор!',
    'MailerEmptyThreadsError' => 'Оберіть Обладнання або Сервіс',

    'profileEdited' => 'Профіль було змінено успішно!',
    'profileImgDeleted' => 'Зображення профілю успішно видалено!',

    'signedIn' => 'Ласкаво просимо!',
    'signedOut' => 'До побачення',

    'messageSent' => 'Повідомлення надіслано!',
    
    'planAlreadyPremium+' => 'У вас вже є безкоштовний Преміум+ аккаунт!',
    'planCancelPremium+' => 'На жаль, зараз ви не можете скасувати безкоштовний Преміум+ доступ',
    
    'postImportError' => 'Сталася помилка під час аналізу файлу імпорту',
    'postImportSuccess' => 'Оголошення успішно імпортовані',

    'importExtError' => 'Дозволені лише файли xlsx.',
    'importStuctureError' => 'Структура файлу імпорту порушена.',
    'importEmptyError' => 'Завантажений файл порожній.',
    'importCompulsoryError' => 'Обов’язкові поля не заповненні.',
    'importThreadError' => 'Поле "Обладнання/Сервіс" заповнене неправильно.',
    'importTypeError' => 'Поле "Тип" заповнене неправильно.',
    'importRoleError' => 'Поле "Сектор" заповнене неправильно.',
    'importConditionError' => 'Поле "Стан" заповнене неправильно.',
    'importTagError' => 'Поле "Категорія" заповнене неправильно.',
    'importCurrencyError' => 'Поле "Валюта" заповнене неправильно.',
    'importRegionError' => 'Поле "Область" заповнене неправильно.',
    'importLifetimeError' => 'Поле "Період життя" заповнене неправильно.',
    'importTitleError' => 'Поле "Заголовок" заповнене неправильно.',
    'importAmountError' => 'Поле "Кількість" заповнене неправильно.',
    'importDescriptionError' => 'Поле "Опис" заповнене неправильно.',
    'importCompanyError' => 'Поле "Компанія" заповнене неправильно.',
    'importManufError' => 'Поле "Виробник" заповнене неправильно.',
    'importManufDateError' => 'Поле "Дата виготовлення" заповнене неправильно.',
    'importPNError' => 'Поле "Заводський код виробу p/n" заповнене неправильно.',
    'importCostError' => 'Поле "Ціна" заповнене неправильно.',
    'importCurrencyMError' => 'Поле "Валюта" є обов\'язковим, якщо вказано "Ціна".',
    'importTownError' => 'Поле "Точне місце розташування" заповнене неправильно.',
    'importEmailError' => 'Поле "Електронна пошта" заповнене неправильно.',
    'importPhoneError' => 'Поле "Номер телефону" заповнене неправильно.',
    'importTagEqualThredError' => 'Поле "Категорія" повинна відповідати полю "Обладнання/Сервіс"',
    'ImportTooManyPostsError' => 'Ви намагаєтеся зробити імпорт :amount оголошень, але у вас залишилося :diff до максимуму.',
];
