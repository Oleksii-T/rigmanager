<?php

//search of tags
Route::get('drugoe',     'SearchController@searchTag')->name('tag-0');
Route::get('burovye-dolota',     'SearchController@searchTag')->name('tag-1');
    Route::get('burovye-dolota/bicentrichnoe-doloto',     'SearchController@searchTag')->name('tag-1.1');
    Route::get('burovye-dolota/doski-otvorota-dolot',     'SearchController@searchTag')->name('tag-1.2');
    Route::get('burovye-dolota/diametromer',     'SearchController@searchTag')->name('tag-1.3');
    Route::get('burovye-dolota/lopastnye-dolota',     'SearchController@searchTag')->name('tag-1.4');
    Route::get('burovye-dolota/nasadki',     'SearchController@searchTag')->name('tag-1.5');
    Route::get('burovye-dolota/pnevmoudarnye-dolota',     'SearchController@searchTag')->name('tag-1.6');
    Route::get('burovye-dolota/sharoshechnoe',     'SearchController@searchTag')->name('tag-1.7');
    Route::get('burovye-dolota/shtyrevye-dolota',     'SearchController@searchTag')->name('tag-1.8');
    Route::get('burovye-dolota/pdc-dolota',     'SearchController@searchTag')->name('tag-1.9');
    Route::get('burovye-dolota/tcp-dolota',     'SearchController@searchTag')->name('tag-1.10');
Route::get('burovye-truby',     'SearchController@searchTag')->name('tag-2');
    Route::get('burovye-truby/bezzamkovye',     'SearchController@searchTag')->name('tag-2.1');
    Route::get('burovye-truby/oblegchennye',     'SearchController@searchTag')->name('tag-2.2');
    Route::get('burovye-truby/obratnye-klapany',     'SearchController@searchTag')->name('tag-2.3');
    Route::get('burovye-truby/patrubki',     'SearchController@searchTag')->name('tag-2.4');
    Route::get('burovye-truby/perevodniki',     'SearchController@searchTag')->name('tag-2.5');
        Route::get('burovye-truby/perevodniki/dempfernye',     'SearchController@searchTag')->name('tag-2.5.1');
    Route::get('burovye-truby/prokladki',     'SearchController@searchTag')->name('tag-2.6');
    Route::get('burovye-truby/stabilizatory',     'SearchController@searchTag')->name('tag-2.7');
    Route::get('burovye-truby/standartnye',     'SearchController@searchTag')->name('tag-2.8');
    Route::get('burovye-truby/tyazhelye',     'SearchController@searchTag')->name('tag-2.9');
    Route::get('burovye-truby/utyazhelennye',     'SearchController@searchTag')->name('tag-2.10');
        Route::get('burovye-truby/utyazhelennye/pryamye-lopasti',     'SearchController@searchTag')->name('tag-2.10.1');
        Route::get('burovye-truby/utyazhelennye/spiralnye-lopasti',     'SearchController@searchTag')->name('tag-2.10.2');
    Route::get('burovye-truby/filtry',     'SearchController@searchTag')->name('tag-2.11');
    Route::get('burovye-truby/centratory',     'SearchController@searchTag')->name('tag-2.12');
    Route::get('burovye-truby/shablony',     'SearchController@searchTag')->name('tag-2.13');
Route::get('burovye-ustanovki',     'SearchController@searchTag')->name('tag-3');
    Route::get('burovye-ustanovki/ankera-ottyazhki',     'SearchController@searchTag')->name('tag-3.1');
    Route::get('burovye-ustanovki/kabina-burilshchika',     'SearchController@searchTag')->name('tag-3.2');
    Route::get('burovye-ustanovki/machta',     'SearchController@searchTag')->name('tag-3.3');
    Route::get('burovye-ustanovki/mbu',     'SearchController@searchTag')->name('tag-3.4');
    Route::get('burovye-ustanovki/mostki',     'SearchController@searchTag')->name('tag-3.5');
    Route::get('burovye-ustanovki/osnova',     'SearchController@searchTag')->name('tag-3.6');
    Route::get('burovye-ustanovki/palatya',     'SearchController@searchTag')->name('tag-3.7');
    Route::get('burovye-ustanovki/pomeshcheniya-osnovaniya',     'SearchController@searchTag')->name('tag-3.8');
    Route::get('burovye-ustanovki/relsa',     'SearchController@searchTag')->name('tag-3.9');
    Route::get('burovye-ustanovki/montazh-demontazh',     'SearchController@searchTag')->name('tag-3.10');
Route::get('nasosy-dlya-burovoj',     'SearchController@searchTag')->name('tag-4');
    Route::get('nasosy-dlya-burovoj/dozirovochnye',     'SearchController@searchTag')->name('tag-4.1');
    Route::get('nasosy-dlya-burovoj/gidro-komponenty',     'SearchController@searchTag')->name('tag-4.2');
        Route::get('nasosy-dlya-burovoj/gidro-komponenty/gidromotory',     'SearchController@searchTag')->name('tag-4.2.1');
        Route::get('nasosy-dlya-burovoj/gidro-komponenty/gidronasosy',     'SearchController@searchTag')->name('tag-4.2.2');
        Route::get('nasosy-dlya-burovoj/gidro-komponenty/regulyatory',     'SearchController@searchTag')->name('tag-4.2.3');
    Route::get('nasosy-dlya-burovoj/burovye',     'SearchController@searchTag')->name('tag-4.3');
        Route::get('nasosy-dlya-burovoj/burovye/dvigatel',     'SearchController@searchTag')->name('tag-4.3.1');
        Route::get('nasosy-dlya-burovoj/burovye/obratnye-klapany',     'SearchController@searchTag')->name('tag-4.3.2');
        Route::get('nasosy-dlya-burovoj/burovye/pult-bur-nasosa',     'SearchController@searchTag')->name('tag-4.3.3');
        Route::get('nasosy-dlya-burovoj/burovye/podpornyj-nasos',     'SearchController@searchTag')->name('tag-4.3.4');
        Route::get('nasosy-dlya-burovoj/burovye/pnevmokompensator',     'SearchController@searchTag')->name('tag-4.3.5');
        Route::get('nasosy-dlya-burovoj/burovye/filtr-vsasyvaniya',     'SearchController@searchTag')->name('tag-4.3.6');
        Route::get('nasosy-dlya-burovoj/burovye/filtr-nagnetaniya',     'SearchController@searchTag')->name('tag-4.3.7');
        Route::get('nasosy-dlya-burovoj/burovye/predohranitelny-klapan',     'SearchController@searchTag')->name('tag-4.3.8');
        Route::get('nasosy-dlya-burovoj/burovye/sistema-ohlazhdeniya',     'SearchController@searchTag')->name('tag-4.3.9');
        Route::get('nasosy-dlya-burovoj/burovye/komponenty',     'SearchController@searchTag')->name('tag-4.3.10');
    Route::get('nasosy-dlya-burovoj/porshnevye',     'SearchController@searchTag')->name('tag-4.4');
    Route::get('nasosy-dlya-burovoj/centrobezhnye',     'SearchController@searchTag')->name('tag-4.5');
    Route::get('nasosy-dlya-burovoj/plunzhernye',     'SearchController@searchTag')->name('tag-4.6');
    Route::get('nasosy-dlya-burovoj/pogruzhnye',     'SearchController@searchTag')->name('tag-4.7');
    Route::get('nasosy-dlya-burovoj/komponenty-nasosa',     'SearchController@searchTag')->name('tag-4.8');
        Route::get('nasosy-dlya-burovoj/komponenty/kompensatory',     'SearchController@searchTag')->name('tag-4.8.1');
        Route::get('nasosy-dlya-burovoj/komponenty/obratnye-klapany',     'SearchController@searchTag')->name('tag-4.8.2');
        Route::get('nasosy-dlya-burovoj/komponenty/filtry',     'SearchController@searchTag')->name('tag-4.8.3');
        Route::get('nasosy-dlya-burovoj/komponenty/vtulki',     'SearchController@searchTag')->name('tag-4.8.4');
Route::get('burovoj-rastvor-tsirkulyatsiya',     'SearchController@searchTag')->name('tag-5');
    Route::get('burovoj-rastvor-tsirkulyatsiya/bufernaya-emkost',     'SearchController@searchTag')->name('tag-5.1');
    Route::get('burovoj-rastvor-tsirkulyatsiya/zadvizhki',     'SearchController@searchTag')->name('tag-5.2');
    Route::get('burovoj-rastvor-tsirkulyatsiya/kompressory',     'SearchController@searchTag')->name('tag-5.3');
    Route::get('burovoj-rastvor-tsirkulyatsiya/linii-davleniya',     'SearchController@searchTag')->name('tag-5.4');
    Route::get('burovoj-rastvor-tsirkulyatsiya/manifoldy',     'SearchController@searchTag')->name('tag-5.5');
    Route::get('burovoj-rastvor-tsirkulyatsiya/ochistka',     'SearchController@searchTag')->name('tag-5.6');
        Route::get('burovoj-rastvor-tsirkulyatsiya/ochistka/vibrosita',     'SearchController@searchTag')->name('tag-5.6.1');
        Route::get('burovoj-rastvor-tsirkulyatsiya/ochistka/degazatory',     'SearchController@searchTag')->name('tag-5.6.2');
        Route::get('burovoj-rastvor-tsirkulyatsiya/ochistka/ilo-otdeliteli',     'SearchController@searchTag')->name('tag-5.6.3');
        Route::get('burovoj-rastvor-tsirkulyatsiya/ochistka/pesko-otdeliteli',     'SearchController@searchTag')->name('tag-5.6.4');
    Route::get('burovoj-rastvor-tsirkulyatsiya/pererabotka',     'SearchController@searchTag')->name('tag-5.7');
    Route::get('burovoj-rastvor-tsirkulyatsiya/prigotovleniye',     'SearchController@searchTag')->name('tag-5.8');
        Route::get('burovoj-rastvor-tsirkulyatsiya/prigotovleniye/miksery',     'SearchController@searchTag')->name('tag-5.8.1');
        Route::get('burovoj-rastvor-tsirkulyatsiya/prigotovleniye/gidrociklonny',     'SearchController@searchTag')->name('tag-5.8.2');
        Route::get('burovoj-rastvor-tsirkulyatsiya/prigotovleniye/bpr',     'SearchController@searchTag')->name('tag-5.8.3');
    Route::get('burovoj-rastvor-tsirkulyatsiya/hraneniye',     'SearchController@searchTag')->name('tag-5.9');
        Route::get('burovoj-rastvor-tsirkulyatsiya/hraneniye/emkosti',     'SearchController@searchTag')->name('tag-5.9.1');
    Route::get('burovoj-rastvor-tsirkulyatsiya/stoyak',     'SearchController@searchTag')->name('tag-5.10');
    Route::get('burovoj-rastvor-tsirkulyatsiya/filtry',     'SearchController@searchTag')->name('tag-5.11');
    Route::get('burovoj-rastvor-tsirkulyatsiya/shlamovye-nasosy',     'SearchController@searchTag')->name('tag-5.12');
    Route::get('burovoj-rastvor-tsirkulyatsiya/shlangi',     'SearchController@searchTag')->name('tag-5.13');
Route::get('gis',     'SearchController@searchTag')->name('tag-6'); 
    Route::get('gis/otbor-kerna',     'SearchController@searchTag')->name('tag-6.1');
        Route::get('gis/otbor-kerna/kernovye-yashchiki',     'SearchController@searchTag')->name('tag-6.1.1');
        Route::get('gis/otbor-kerna/kernootbornyj-snaryad',     'SearchController@searchTag')->name('tag-6.1.2');
        Route::get('gis/otbor-kerna/kernopriemniki',     'SearchController@searchTag')->name('tag-6.1.3');
        Route::get('gis/otbor-kerna/kolonkovye-truby',     'SearchController@searchTag')->name('tag-6.1.4');
        Route::get('gis/otbor-kerna/koronki',     'SearchController@searchTag')->name('tag-6.1.5');
    Route::get('gis/karotazh',     'SearchController@searchTag')->name('tag-6.2');
        Route::get('gis/karotazh/videokarotazh',     'SearchController@searchTag')->name('tag-6.2.1');
        Route::get('gis/karotazh/dop-oborudovanie',     'SearchController@searchTag')->name('tag-6.2.2');
        Route::get('gis/karotazh/inklinometriya',     'SearchController@searchTag')->name('tag-6.2.3');
        Route::get('gis/karotazh/kavernometriya',     'SearchController@searchTag')->name('tag-6.2.4');
        Route::get('gis/karotazh/karotazhnye-stancii',     'SearchController@searchTag')->name('tag-6.2.5');
        Route::get('gis/karotazh/katushki',     'SearchController@searchTag')->name('tag-6.2.6');
        Route::get('gis/karotazh/lebedki',     'SearchController@searchTag')->name('tag-6.2.7');
        Route::get('gis/karotazh/magnitorazvedka',     'SearchController@searchTag')->name('tag-6.2.8');
        Route::get('gis/karotazh/napravlenie-dvizheniya-vody',     'SearchController@searchTag')->name('tag-6.2.9');
        Route::get('gis/karotazh/radiometriya',     'SearchController@searchTag')->name('tag-6.2.10');
        Route::get('gis/karotazh/raskhodometriya',     'SearchController@searchTag')->name('tag-6.2.11');
        Route::get('gis/karotazh/registriruyushchie-sistemy',     'SearchController@searchTag')->name('tag-6.2.12');
        Route::get('gis/karotazh/sejsmorazvedka',     'SearchController@searchTag')->name('tag-6.2.13');
        Route::get('gis/karotazh/fotometriya-i-nefelometriya',     'SearchController@searchTag')->name('tag-6.2.14');
        Route::get('gis/karotazh/ehlektrorazvedka',     'SearchController@searchTag')->name('tag-6.2.15');
Route::get('vspomogatelnoe',     'SearchController@searchTag')->name('tag-7');
    Route::get('vspomogatelnoe/zatochnoe',     'SearchController@searchTag')->name('tag-7.1');
        Route::get('vspomogatelnoe/zatochnoe/ruchnye-mashinki',     'SearchController@searchTag')->name('tag-7.1.1');
        Route::get('vspomogatelnoe/zatochnoe/kolpachki',     'SearchController@searchTag')->name('tag-7.1.2');
    Route::get('vspomogatelnoe/kerher',     'SearchController@searchTag')->name('tag-7.2');
    Route::get('vspomogatelnoe/mashinnye-klyuchi',     'SearchController@searchTag')->name('tag-7.3');
    Route::get('vspomogatelnoe/podporki-linij',     'SearchController@searchTag')->name('tag-7.4');
    Route::get('vspomogatelnoe/rezak',     'SearchController@searchTag')->name('tag-7.5');
    Route::get('vspomogatelnoe/svarka',     'SearchController@searchTag')->name('tag-7.6');
        Route::get('vspomogatelnoe/svarka/gazosvarka',     'SearchController@searchTag')->name('tag-7.6.1');
        Route::get('vspomogatelnoe/svarka/ehlektrosvarka',     'SearchController@searchTag')->name('tag-7.6.2');
Route::get('zabojnye-dvigatelya',     'SearchController@searchTag')->name('tag-8');
    Route::get('zabojnye-dvigatelya/vrashchatelnye',     'SearchController@searchTag')->name('tag-8.1');
    Route::get('zabojnye-dvigatelya/udarnye',     'SearchController@searchTag')->name('tag-8.2');
    Route::get('zabojnye-dvigatelya/pnevmaticheskie',     'SearchController@searchTag')->name('tag-8.3');
    Route::get('zabojnye-dvigatelya/gidravlicheskie-d',     'SearchController@searchTag')->name('tag-8.4');
    Route::get('zabojnye-dvigatelya/ehlektricheskie',     'SearchController@searchTag')->name('tag-8.5');
Route::get('zapchasti',     'SearchController@searchTag')->name('tag-9');
Route::get('izmeritelnoe-oborudovanie',     'SearchController@searchTag')->name('tag-10');
    Route::get('izmeritelnoe-oborudovanie/datchik',     'SearchController@searchTag')->name('tag-10.1');
    Route::get('izmeritelnoe-oborudovanie/instrumenty',     'SearchController@searchTag')->name('tag-10.2');
    Route::get('izmeritelnoe-oborudovanie/kabelya',     'SearchController@searchTag')->name('tag-10.3');
    Route::get('izmeritelnoe-oborudovanie/kamery',     'SearchController@searchTag')->name('tag-10.4');
    Route::get('izmeritelnoe-oborudovanie/registracionnoe-oborudovanie',     'SearchController@searchTag')->name('tag-10.5');
    Route::get('izmeritelnoe-oborudovanie/specialnoe-oborudovanie-gds',     'SearchController@searchTag')->name('tag-10.6');
Route::get('kalibratory',     'SearchController@searchTag')->name('tag-11');
    Route::get('kalibratory/lopastnye-kls',     'SearchController@searchTag')->name('tag-11.1');
    Route::get('kalibratory/pnevmoudarnye',     'SearchController@searchTag')->name('tag-11.2');
    Route::get('kalibratory/razdvizhnye',     'SearchController@searchTag')->name('tag-11.3');
    Route::get('kalibratory/sharoshechnye',     'SearchController@searchTag')->name('tag-11.4');
    Route::get('kalibratory/sharoshki',     'SearchController@searchTag')->name('tag-11.5');
    Route::get('kalibratory/pdc',     'SearchController@searchTag')->name('tag-11.6');
Route::get('kampus',     'SearchController@searchTag')->name('tag-12');
    Route::get('kampus/dushevaya',     'SearchController@searchTag')->name('tag-12.1');
    Route::get('kampus/zhilye-domiki',     'SearchController@searchTag')->name('tag-12.2');
    Route::get('kampus/kuhnya',     'SearchController@searchTag')->name('tag-12.3');
    Route::get('kampus/med-chast',     'SearchController@searchTag')->name('tag-12.4');
    Route::get('kampus/tualety',     'SearchController@searchTag')->name('tag-12.5');
    Route::get('kampus/ehlektrika',     'SearchController@searchTag')->name('tag-12.6');
Route::get('krepleniya-tsementazh',     'SearchController@searchTag')->name('tag-13');
    Route::get('krepleniya-tsementazh/bashmaki',     'SearchController@searchTag')->name('tag-13.1');
    Route::get('krepleniya-tsementazh/obsadnye-truby',     'SearchController@searchTag')->name('tag-13.2');
    Route::get('krepleniya-tsementazh/osnastka',     'SearchController@searchTag')->name('tag-13.3');
        Route::get('krepleniya-tsementazh/osnastka/mufty',     'SearchController@searchTag')->name('tag-13.3.1');
        Route::get('krepleniya-tsementazh/osnastka/obratnye-klapany',     'SearchController@searchTag')->name('tag-13.3.2');
        Route::get('krepleniya-tsementazh/osnastka/probki-napravlyayushchie',     'SearchController@searchTag')->name('tag-13.3.3');
        Route::get('krepleniya-tsementazh/osnastka/centratory-turbulizatory',     'SearchController@searchTag')->name('tag-13.3.4');
    Route::get('krepleniya-tsementazh/patrubki',     'SearchController@searchTag')->name('tag-13.4');
    Route::get('krepleniya-tsementazh/perevodniki',     'SearchController@searchTag')->name('tag-13.5');
    Route::get('krepleniya-tsementazh/skrebki',     'SearchController@searchTag')->name('tag-13.6');
    Route::get('krepleniya-tsementazh/cementazh',     'SearchController@searchTag')->name('tag-13.7');
        Route::get('krepleniya-tsementazh/cementazh/korziny-cementirovochnye',     'SearchController@searchTag')->name('tag-13.7.1');
        Route::get('krepleniya-tsementazh/cementazh/msc',     'SearchController@searchTag')->name('tag-13.7.2');
        Route::get('krepleniya-tsementazh/cementazh/cherez-stinger',     'SearchController@searchTag')->name('tag-13.7.3');
        Route::get('krepleniya-tsementazh/cementazh/cementny-mostu',     'SearchController@searchTag')->name('tag-13.7.4');
        Route::get('krepleniya-tsementazh/cementazh/obratnye-klapany',     'SearchController@searchTag')->name('tag-13.7.5');
        Route::get('krepleniya-tsementazh/cementazh/pakery',     'SearchController@searchTag')->name('tag-13.7.6');
        Route::get('krepleniya-tsementazh/cementazh/probki-cementirovochnye',     'SearchController@searchTag')->name('tag-13.7.7');
        Route::get('krepleniya-tsementazh/cementazh/upornoe-kolco',     'SearchController@searchTag')->name('tag-13.7.8');
Route::get('likvidatsiya-avarij',     'SearchController@searchTag')->name('tag-14');
    Route::get('likvidatsiya-avarij/avarijnyj-klapan',     'SearchController@searchTag')->name('tag-14.1');
    Route::get('likvidatsiya-avarij/vanna',     'SearchController@searchTag')->name('tag-14.2');
    Route::get('likvidatsiya-avarij/lovilnyj-instrument',     'SearchController@searchTag')->name('tag-14.3');
        Route::get('likvidatsiya-avarij/lovilnyj-instrument/kolokola',     'SearchController@searchTag')->name('tag-14.3.1');
        Route::get('likvidatsiya-avarij/lovilnyj-instrument/magnity',     'SearchController@searchTag')->name('tag-14.3.2');
        Route::get('likvidatsiya-avarij/lovilnyj-instrument/metchiki',     'SearchController@searchTag')->name('tag-14.3.3');
    Route::get('likvidatsiya-avarij/pechatka',     'SearchController@searchTag')->name('tag-14.4');
    Route::get('likvidatsiya-avarij/frez',     'SearchController@searchTag')->name('tag-14.5');
    Route::get('likvidatsiya-avarij/shlamoulovitel',     'SearchController@searchTag')->name('tag-14.6');
Route::get('smazka',     'SearchController@searchTag')->name('tag-15');
    Route::get('smazka/dlya-burovyh-trub',     'SearchController@searchTag')->name('tag-15.1');
    Route::get('smazka/dlya-klyuchej',     'SearchController@searchTag')->name('tag-15.2');
    Route::get('smazka/dlya-nasosov',     'SearchController@searchTag')->name('tag-15.3');
    Route::get('smazka/dlya-nkt',     'SearchController@searchTag')->name('tag-15.4');
    Route::get('smazka/dlya-obsadnyh-trub',     'SearchController@searchTag')->name('tag-15.5');
Route::get('nkt-i-osnastka',     'SearchController@searchTag')->name('tag-16');
    Route::get('nkt-i-osnastka/klapan-sbivnoj',     'SearchController@searchTag')->name('tag-16.1');
    Route::get('nkt-i-osnastka/koltyubing',     'SearchController@searchTag')->name('tag-16.2');
    Route::get('nkt-i-osnastka/nkt',     'SearchController@searchTag')->name('tag-16.3');
    Route::get('nkt-i-osnastka/patrubki',     'SearchController@searchTag')->name('tag-16.4');
    Route::get('nkt-i-osnastka/perevodniki',     'SearchController@searchTag')->name('tag-16.5');
Route::get('oborudovanie-ustya',     'SearchController@searchTag')->name('tag-17');
    Route::get('oborudovanie-ustya/kolonnaya-golovka',     'SearchController@searchTag')->name('tag-17.1');
    Route::get('oborudovanie-ustya/fontannaya-armatura',     'SearchController@searchTag')->name('tag-17.2');
Route::get('pakery-i-komplektuyushchie',     'SearchController@searchTag')->name('tag-18');
    Route::get('pakery-i-komplektuyushchie/nasosy-dlya-nakachki',     'SearchController@searchTag')->name('tag-18.1');
    Route::get('pakery-i-komplektuyushchie/obratnye-klapany',     'SearchController@searchTag')->name('tag-18.2');
    Route::get('pakery-i-komplektuyushchie/standartnye-pakery',     'SearchController@searchTag')->name('tag-18.3');
    Route::get('pakery-i-komplektuyushchie/trubki-dlya-naduvaniya',     'SearchController@searchTag')->name('tag-18.4');
    Route::get('pakery-i-komplektuyushchie/shlangi-inekcionnye',     'SearchController@searchTag')->name('tag-18.5');
Route::get('pnevmosistema',     'SearchController@searchTag')->name('tag-19');
    Route::get('pnevmosistema/vozduho-provod',     'SearchController@searchTag')->name('tag-19.1');
    Route::get('pnevmosistema/vozdushnyj-rezervuar',     'SearchController@searchTag')->name('tag-19.2');
    Route::get('pnevmosistema/kompensatory',     'SearchController@searchTag')->name('tag-19.3');
    Route::get('pnevmosistema/osushitel-vozduha',     'SearchController@searchTag')->name('tag-19.4');
Route::get('protivofonka',     'SearchController@searchTag')->name('tag-20');
    Route::get('protivofonka/upravlenie',     'SearchController@searchTag')->name('tag-20.1');
        Route::get('protivofonka/upravlenie/gidroakkumulyatory',     'SearchController@searchTag')->name('tag-20.1.1');
        Route::get('protivofonka/upravlenie/ruchnye',     'SearchController@searchTag')->name('tag-20.1.2');
        Route::get('protivofonka/upravlenie/distancionnoe',     'SearchController@searchTag')->name('tag-20.1.3');
    Route::get('protivofonka/degazatory',     'SearchController@searchTag')->name('tag-20.2');
    Route::get('protivofonka/zadvizhki-katushki-klapana',     'SearchController@searchTag')->name('tag-20.3');
    Route::get('protivofonka/linii',     'SearchController@searchTag')->name('tag-20.4');
        Route::get('protivofonka/linii/glusheniya',     'SearchController@searchTag')->name('tag-20.4.1');
        Route::get('protivofonka/linii/drosselirovaniya',     'SearchController@searchTag')->name('tag-20.4.2');
    Route::get('protivofonka/manifoldy',     'SearchController@searchTag')->name('tag-20.5');
        Route::get('protivofonka/manifoldy/glusheniya',     'SearchController@searchTag')->name('tag-20.5.1');
        Route::get('protivofonka/manifoldy/drosselirovaniya',     'SearchController@searchTag')->name('tag-20.5.2');
    Route::get('protivofonka/plashki',     'SearchController@searchTag')->name('tag-20.6');
        Route::get('protivofonka/plashki/gluhie',     'SearchController@searchTag')->name('tag-20.6.1');
        Route::get('protivofonka/plashki/sreznye',     'SearchController@searchTag')->name('tag-20.6.2');
        Route::get('protivofonka/plashki/trubnye',     'SearchController@searchTag')->name('tag-20.6.3');
    Route::get('protivofonka/preventor',     'SearchController@searchTag')->name('tag-20.7');
        Route::get('protivofonka/preventor/odinarnyj',     'SearchController@searchTag')->name('tag-20.7.1');
        Route::get('protivofonka/preventor/sdvoennyj',     'SearchController@searchTag')->name('tag-20.7.2');
        Route::get('protivofonka/preventor/universalnyj',     'SearchController@searchTag')->name('tag-20.7.3');
        Route::get('protivofonka/preventor/krestovina',     'SearchController@searchTag')->name('tag-20.7.4');
    Route::get('protivofonka/fakel',     'SearchController@searchTag')->name('tag-20.8');
        Route::get('protivofonka/fakel/stvol',     'SearchController@searchTag')->name('tag-20.8.1');
        Route::get('protivofonka/fakel/kontrol-avtomatizaciya',     'SearchController@searchTag')->name('tag-20.8.2');
        Route::get('protivofonka/fakel/zapalnoe-ustrojstvo',     'SearchController@searchTag')->name('tag-20.8.3');
        Route::get('protivofonka/fakel/truboprovody',     'SearchController@searchTag')->name('tag-20.8.4');
Route::get('vrashchenie',     'SearchController@searchTag')->name('tag-21');
    Route::get('vrashchenie/vedushchie-truby',     'SearchController@searchTag')->name('tag-21.1');
    Route::get('vrashchenie/vertlyugi',     'SearchController@searchTag')->name('tag-21.2');
    Route::get('vrashchenie/verhnie-privody',     'SearchController@searchTag')->name('tag-21.3');
        Route::get('vrashchenie/verhnie-privody/avarijnoye',     'SearchController@searchTag')->name('tag-21.3.1');
        Route::get('vrashchenie/verhnie-privody/val',     'SearchController@searchTag')->name('tag-21.3.2');
        Route::get('vrashchenie/verhnie-privody/gidravlika',     'SearchController@searchTag')->name('tag-21.3.3');
        Route::get('vrashchenie/verhnie-privody/gryazevye-truby',     'SearchController@searchTag')->name('tag-21.3.4');
        Route::get('vrashchenie/verhnie-privody/datchiki',     'SearchController@searchTag')->name('tag-21.3.5');
        Route::get('vrashchenie/verhnie-privody/dok-stanciya',     'SearchController@searchTag')->name('tag-21.3.6');
        Route::get('vrashchenie/verhnie-privody/komponenty-svp',     'SearchController@searchTag')->name('tag-21.3.7');
        Route::get('vrashchenie/verhnie-privody/krany-sharovye',     'SearchController@searchTag')->name('tag-21.3.8');
        Route::get('vrashchenie/verhnie-privody/relsa',     'SearchController@searchTag')->name('tag-21.3.9');
        Route::get('vrashchenie/verhnie-privody/obratnye-klapany',     'SearchController@searchTag')->name('tag-21.3.10');
        Route::get('vrashchenie/verhnie-privody/promyvochnyj',     'SearchController@searchTag')->name('tag-21.3.11');
        Route::get('vrashchenie/verhnie-privody/pult-upravleniya',     'SearchController@searchTag')->name('tag-21.3.12');
        Route::get('vrashchenie/verhnie-privody/shtropy',     'SearchController@searchTag')->name('tag-21.3.13');
        Route::get('vrashchenie/verhnie-privody/ehlektro-dvigateli',     'SearchController@searchTag')->name('tag-21.3.14');
    Route::get('vrashchenie/rotor',     'SearchController@searchTag')->name('tag-21.4');
        Route::get('vrashchenie/rotor/vkladyshi',     'SearchController@searchTag')->name('tag-21.4.1');
        Route::get('vrashchenie/rotor/komponenty-rotora',     'SearchController@searchTag')->name('tag-21.4.2');
        Route::get('vrashchenie/rotor/privod',     'SearchController@searchTag')->name('tag-21.4.3');
        Route::get('vrashchenie/rotor/tormozheniye',     'SearchController@searchTag')->name('tag-21.4.4');
Route::get('sistema-pitaniya',     'SearchController@searchTag')->name('tag-22');
    Route::get('sistema-pitaniya/bloki-raspredeleniya',     'SearchController@searchTag')->name('tag-22.1');
    Route::get('sistema-pitaniya/generatory',     'SearchController@searchTag')->name('tag-22.2');
    Route::get('sistema-pitaniya/kabelya',     'SearchController@searchTag')->name('tag-22.3');
    Route::get('sistema-pitaniya/transformatory-mms',     'SearchController@searchTag')->name('tag-22.4');
Route::get('odnovremennaya-obsadka',     'SearchController@searchTag')->name('tag-23');
    Route::get('odnovremennaya-obsadka/simmetrichnaya',     'SearchController@searchTag')->name('tag-23.1');
    Route::get('odnovremennaya-obsadka/s-razdvizhnymi-lopastyami',     'SearchController@searchTag')->name('tag-23.2');
        Route::get('odnovremennaya-obsadka/s-razdvizhnymi-lopastyami/bashmaki',     'SearchController@searchTag')->name('tag-23.2.1');
        Route::get('odnovremennaya-obsadka/s-razdvizhnymi-lopastyami/razdvizhnye-dolota',     'SearchController@searchTag')->name('tag-23.2.2');
Route::get('sklad-pmm',     'SearchController@searchTag')->name('tag-24');
    Route::get('sklad-pmm/ballonny',     'SearchController@searchTag')->name('tag-24.1');
    Route::get('sklad-pmm/bloki-zapravki',     'SearchController@searchTag')->name('tag-24.2');
    Route::get('sklad-pmm/emkosti',     'SearchController@searchTag')->name('tag-24.3');
    Route::get('sklad-pmm/izmeritelnoe',     'SearchController@searchTag')->name('tag-24.4');
    Route::get('sklad-pmm/toplivo',     'SearchController@searchTag')->name('tag-24.5');
Route::get('specialnaya-tekhnika',     'SearchController@searchTag')->name('tag-25');
    Route::get('specialnaya-tekhnika/kran',     'SearchController@searchTag')->name('tag-25.1');
    Route::get('specialnaya-tekhnika/pogruzchik',     'SearchController@searchTag')->name('tag-25.2');
    Route::get('specialnaya-tekhnika/transportnye-mashiny',     'SearchController@searchTag')->name('tag-25.3');
    Route::get('specialnaya-tekhnika/cementirovochnyj-agregat',     'SearchController@searchTag')->name('tag-25.4');
Route::get('talevaya-sistema',     'SearchController@searchTag')->name('tag-26');
    Route::get('talevaya-sistema/avarijnyj-privod',     'SearchController@searchTag')->name('tag-26.1');
    Route::get('talevaya-sistema/burovoj-kryuk',     'SearchController@searchTag')->name('tag-26.2');
    Route::get('talevaya-sistema/burovaya-lebedka-talkanat',     'SearchController@searchTag')->name('tag-26.3');
        Route::get('talevaya-sistema/burovaya-lebedka-talkanat/baraban',     'SearchController@searchTag')->name('tag-26.3.1');
        Route::get('talevaya-sistema/burovaya-lebedka-talkanat/privod',     'SearchController@searchTag')->name('tag-26.3.2');
        Route::get('talevaya-sistema/burovaya-lebedka-talkanat/sistema-ohlazhdeniya',     'SearchController@searchTag')->name('tag-26.3.3');
        Route::get('talevaya-sistema/burovaya-lebedka-talkanat/sistema-tormozheniya',     'SearchController@searchTag')->name('tag-26.3.4');
        Route::get('talevaya-sistema/burovaya-lebedka-talkanat/talkanat',     'SearchController@searchTag')->name('tag-26.3.5');
        Route::get('talevaya-sistema/burovaya-lebedka-talkanat/ehlektro-dviteli',     'SearchController@searchTag')->name('tag-26.3.6');
    Route::get('talevaya-sistema/dopolnitelnye-kanaty',     'SearchController@searchTag')->name('tag-26.4');
    Route::get('talevaya-sistema/kreplenie-konca-talevogo',     'SearchController@searchTag')->name('tag-26.5');
    Route::get('talevaya-sistema/kronblok',     'SearchController@searchTag')->name('tag-26.6');
    Route::get('talevaya-sistema/talevyj-blok',     'SearchController@searchTag')->name('tag-26.7');
Route::get('spusko-podemnyj-instrument',     'SearchController@searchTag')->name('tag-27');
    Route::get('spusko-podemnyj-instrument/klinya',     'SearchController@searchTag')->name('tag-27.1');
    Route::get('spusko-podemnyj-instrument/podemnye-probki',     'SearchController@searchTag')->name('tag-27.2');
    Route::get('spusko-podemnyj-instrument/ruchnye-zazhimy',     'SearchController@searchTag')->name('tag-27.3');
    Route::get('spusko-podemnyj-instrument/spajdera',     'SearchController@searchTag')->name('tag-27.4');
    Route::get('spusko-podemnyj-instrument/homuty',     'SearchController@searchTag')->name('tag-27.5');
    Route::get('spusko-podemnyj-instrument/homuty-dlya-obsadnyh',     'SearchController@searchTag')->name('tag-27.6');
    Route::get('spusko-podemnyj-instrument/ehlevatory',     'SearchController@searchTag')->name('tag-27.7');
        Route::get('spusko-podemnyj-instrument/ehlevatory/vneshnim-zahvatom',     'SearchController@searchTag')->name('tag-27.7.1');
        Route::get('spusko-podemnyj-instrument/ehlevatory/vnutrennim-zahvatom',     'SearchController@searchTag')->name('tag-27.7.2');
Route::get('oborudovanie-tb',     'SearchController@searchTag')->name('tag-28');
    Route::get('oborudovanie-tb/pozharnaya-sistema',     'SearchController@searchTag')->name('tag-28.1');
    Route::get('oborudovanie-tb/signalizaciya',     'SearchController@searchTag')->name('tag-28.2');
    Route::get('oborudovanie-tb/sistema-zhizneobespecheniya',     'SearchController@searchTag')->name('tag-28.3');
    Route::get('oborudovanie-tb/svetovaya-sistema',     'SearchController@searchTag')->name('tag-28.4');
    Route::get('oborudovanie-tb/personalnaya-zashchita',     'SearchController@searchTag')->name('tag-28.5');
    Route::get('oborudovanie-tb/dop-oborudovanie',     'SearchController@searchTag')->name('tag-28.6');
Route::get('burovye-klyuchi',     'SearchController@searchTag')->name('tag-29');
    Route::get('burovye-klyuchi/komponenty-klyuchey',     'SearchController@searchTag')->name('tag-29.1');
    Route::get('burovye-klyuchi/gidravlicheskie-k',     'SearchController@searchTag')->name('tag-29.2');
        Route::get('burovye-klyuchi/gidravlicheskie-k/dok-stanciya',     'SearchController@searchTag')->name('tag-29.2.1');
    Route::get('burovye-klyuchi/dlya-nkt',     'SearchController@searchTag')->name('tag-29.3');
    Route::get('burovye-klyuchi/dlya-obsadnoj-kolonny',     'SearchController@searchTag')->name('tag-29.4');
    Route::get('burovye-klyuchi/mekhanicheskie-klyuchi',     'SearchController@searchTag')->name('tag-29.5');
    Route::get('burovye-klyuchi/podkladnye-vilki',     'SearchController@searchTag')->name('tag-29.6');
    Route::get('burovye-klyuchi/trubnye-klyuchi',     'SearchController@searchTag')->name('tag-29.7');
    Route::get('burovye-klyuchi/cepnye-klyuchi',     'SearchController@searchTag')->name('tag-29.8');
    Route::get('burovye-klyuchi/sharnirnye-klyuchi',     'SearchController@searchTag')->name('tag-29.9');
Route::get('himicheskie-reagenty',     'SearchController@searchTag')->name('tag-30');
    Route::get('himicheskie-reagenty/reagenty-stabilizatory',     'SearchController@searchTag')->name('tag-30.1');
    Route::get('himicheskie-reagenty/utyazheliteli',     'SearchController@searchTag')->name('tag-30.2');
    Route::get('himicheskie-reagenty/kolmatanty',     'SearchController@searchTag')->name('tag-30.3');
    Route::get('himicheskie-reagenty/bentonity-zameniteli',     'SearchController@searchTag')->name('tag-30.4');
    Route::get('himicheskie-reagenty/neorganicheskie-reagenty',     'SearchController@searchTag')->name('tag-30.5');
    Route::get('himicheskie-reagenty/smazochnye-dobavki',     'SearchController@searchTag')->name('tag-30.6');
Route::get('himicheskaya-laboratoriya',     'SearchController@searchTag')->name('tag-31');
    Route::get('himicheskaya-laboratoriya/izmereniya-plotnosti',     'SearchController@searchTag')->name('tag-31.1');
    Route::get('himicheskaya-laboratoriya/izmereniya-udelnogo-vesa',     'SearchController@searchTag')->name('tag-31.2');
    Route::get('himicheskaya-laboratoriya/izmereniya-vyazkosti',     'SearchController@searchTag')->name('tag-31.3');
    Route::get('himicheskaya-laboratoriya/izmereniya-sns',     'SearchController@searchTag')->name('tag-31.4');
    Route::get('himicheskaya-laboratoriya/izmereniya-ph',     'SearchController@searchTag')->name('tag-31.5');
    Route::get('himicheskaya-laboratoriya/izmereniya-vodootdachi',     'SearchController@searchTag')->name('tag-31.6');
Route::get('yasy',     'SearchController@searchTag')->name('tag-32');
    Route::get('yasy/gidromekhanicheskie',     'SearchController@searchTag')->name('tag-32.1');
    Route::get('yasy/gidravlicheskie-y',     'SearchController@searchTag')->name('tag-32.2');


// SERVICES
Route::get('drugoj-servis',     'SearchController@searchTag')->name('tag-50');
Route::get('kompleksnye-uslugi',     'SearchController@searchTag')->name('tag-51');
Route::get('avarijnye-raboty',     'SearchController@searchTag')->name('tag-52');
Route::get('avarijnaya-sluzhba',     'SearchController@searchTag')->name('tag-53');
Route::get('burovoj-podryadchik',     'SearchController@searchTag')->name('tag-75');
Route::get('vybrosy-v-atmosferu',     'SearchController@searchTag')->name('tag-54');
Route::get('geologo-issledovanie-skvazhiny',     'SearchController@searchTag')->name('tag-55');
    Route::get('geologo-issledovanie-skvazhiny/otbor-kerna',     'SearchController@searchTag')->name('tag-55.1');
    Route::get('geologo-issledovanie-skvazhiny/karotazh',     'SearchController@searchTag')->name('tag-55.2');
Route::get('defektoskopiya-i-sertifikaciya',     'SearchController@searchTag')->name('tag-56');
Route::get('dolotnyj-servis',     'SearchController@searchTag')->name('tag-57');
Route::get('servis-zabojnye-dvigatelya',     'SearchController@searchTag')->name('tag-58');
Route::get('zazemlenie',     'SearchController@searchTag')->name('tag-59');
Route::get('naklonno-napravlennoe-burenie',     'SearchController@searchTag')->name('tag-61');
Route::get('osnashchenie-ok',     'SearchController@searchTag')->name('tag-62');
Route::get('ohrana',     'SearchController@searchTag')->name('tag-63');
Route::get('pvo',     'SearchController@searchTag')->name('tag-64');
Route::get('podbor-personala',     'SearchController@searchTag')->name('tag-65');
Route::get('postavka-trub',     'SearchController@searchTag')->name('tag-66');
Route::get('prk-azs-pazs',     'SearchController@searchTag')->name('tag-67');
Route::get('spec-tekhnika',     'SearchController@searchTag')->name('tag-68');
Route::get('stroiteli',     'SearchController@searchTag')->name('tag-69');
Route::get('stanciya-gti',     'SearchController@searchTag')->name('tag-70');
Route::get('transportniki',     'SearchController@searchTag')->name('tag-71');
Route::get('utilizaciya-othodov',     'SearchController@searchTag')->name('tag-72');
    Route::get('utilizaciya-othodov/burovyh',     'SearchController@searchTag')->name('tag-72.1');
    Route::get('utilizaciya-othodov/bytovyh',     'SearchController@searchTag')->name('tag-72.2');
Route::get('him-laboratoriya-kontrolya',     'SearchController@searchTag')->name('tag-73');
Route::get('cementazhniki',     'SearchController@searchTag')->name('tag-74');