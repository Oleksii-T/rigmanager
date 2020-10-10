<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        factory(App\Post::class, 50)->create();

        DB::table('usd_exchanges')->insert([
            'id' => 1,
            'currency' => 'UAH',
            'buy' => '0',
            'sell' => '0',
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now()
        ]);

        DB::table('usd_exchanges')->insert([
            'id' => 2,
            'currency' => 'EUR',
            'buy' => '0',
            'sell' => '0',
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now()
        ]);

        \App\Http\Controllers\UsdExchangeController::update();

        DB::table('users')->insert([
            'id' => 1,
            'name' => 'Administrator',
            'phone_raw' => '0502115147',
            'email' => 'alex.tarbeev@gmail.com',
            'email_verified_at' => Carbon\Carbon::now(),
            'password' => Hash::make('Admin1'),
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now()
        ]);

        DB::table('posts')->insert([
            'user_id' => 1,
            'thread' => 1,
            'origin_lang' => 'ru',
            'user_translations' => '{"title":[],"description":[]}',
            'title' => 'Буровая штанга 89х6,5х1000 мм, резьба З-73',
            'title_uk' => 'Бурова штанга 89х6,5х1000 мм, різьба З-73',
            'title_en' => 'Drilling pipe 89х6,5х1000 mm, thread З-73',
            'type' => '1',
            'role' => '2',
            'condition' => 2,
            'tag_encoded' => '2.8',
            'description' => 'Производитель:	DM Bits
                Страна происхождения:	РОССИЯ
                Cрок поставки:	3-4 недели
                Основные технические параметры
                
                Длина, мм:	1 000
                Резьба:	2 3/8" IF - З-73
                Материал корпуса трубы:	сталь 45
                Толщина стенки, мм:	6,5
                Способ присоединения замков:	сварка полуавтоматом
                Материал замка трубы:	сталь 30ХГСА с термообработкой до 32 HRC
                Резьба ГОСТ:	З-73
                Резьба API 7-1 (ГОСТ):	З-73
                Резьба API (ГОСТ):	З-73',
            'description_uk' => 'Виробник: DM Bits
                Країна походження: РОСІЯ
                Термін поставки: 3-4 тижні
                Основні технічні параметри
            
                Довжина, мм: 1 000
                Різьблення: 2 3/8 "IF - З-73
                Матеріал корпусу труби: сталь 45
                Товщина стінки, мм: 6,5
                Спосіб приєднання замків: зварювання напівавтоматом
                Матеріал замку труби: сталь 30ХГСА з термообробкою до 32 HRC
                Різьба ГОСТ: З-73
                Різьба API 7-1 (ГОСТ): З-73
                Різьба API (ГОСТ): З-73', 
            'description_en' => 'Manufacturer: DM Bits
                Country of origin: RUSSIA
                Delivery time: 3-4 weeks
                Main technical parameters
            
                Length, mm: 1,000
                Thread: 2 3/8 "IF - З-73
                Pipe body material: steel 45
                Wall thickness, mm: 6.5
                Method of joining locks: welding by semiautomatic device
                Pipe joint material: steel 30HGSA with heat treatment up to 32 HRC
                GOST thread: З-73
                Thread API 7-1 (GOST): З-73
                API thread (GOST): З-73', 
            'cost' => '5148.00',
            'currency' => 'UAH',
            'user_email' => 'alex.tarbeev@gmail.com',
            'user_phone_raw' => '0502115147',
            'viber' => '1',
            'telegram' => '1',
            'whatsapp' => '1',
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now()
        ]);

        DB::table('posts')->insert([
            'user_id' => 1,
            'thread' => 1,
            'origin_lang' => 'ru',
            'user_translations' => '{"title":[],"description":[]}',
            'title' => 'Вертлюг 6WC',
            'title_uk' => 'Вертлюг 6WC',
            'title_en' => 'Swivel 6WC',
            'type' => '1',
            'role' => '2',
            'condition' => 2,
            'tag_encoded' => '21.2',
            'description' => 'Производитель:	Western Rubber
                Страна происхождения:	СОЕДИНЕННЫЕ ШТАТЫ
                Cрок поставки:	8-10 недель
                Информация о товаре
                Буровой вертлгюг 6WC спроектирован для бурения водозаборных скважин большого диаметра и скважин при ведении строительных работ. Данный вертлюг очень компактный и имеет внутреннее проходное отверстие 6" (152 мм), может использоваться как для прямой, так и обратной циркуляции скважин.
                
                Основные преимущества:
                
                - большое проходное отверстие 6" (152 мм)
                - быстрая замена сальников вертлюга
                - регулируемые подшипники и уплотнения
                - 2" NPT соедениен для воздушной трубки
                Основные технические параметры
                
                Длина, мм:	1 524
                Проходное отверстие, мм:	152,4
                Макс.нагрузка при вращении, кг:	36
                Макс.статичесткая нагрузка, кг:	78,75
                Макс.давление, кПа:	10 200
                Вес нетто, кг:	408
                Тип соединения на выходе:	6" фланец
                Информация для отгрузки
                
                Вес, кг:	508
                Отгрузочные размеры, мм:	1800x710x970',
            'description_uk' => 'Виробник: Western Rubber
                Країна походження: СПОЛУЧЕНИХ ШТАТІВ
                Термін поставки: 8-10 тижнів
                Інформація про товар
                Бурової вертлгюг 6WC спроектований для буріння водозабірних свердловин великого діаметра і свердловин при веденні будівельних робіт. Даний вертлюг дуже компактний і має внутрішнє прохідний отвір 6 "(152 мм), може використовуватися як для прямої, так і зворотної циркуляції свердловин.
                
                Основні переваги:
                
                - велике прохідне отвір 6 "(152 мм)
                - швидка заміна сальників вертлюга
                - регульовані підшипники і ущільнення
                - 2 "NPT злився для повітряної трубки
                Основні технічні параметри
                
                Довжина, мм: 1 524
                Прохідний отвір, мм: 152,4
                Макс.нагрузка при обертанні, кг: 36
                Макс.статічесткая навантаження, кг: 78,75
                Макс.давленіе, кПа: 10 200
                Вага нетто, кг: 408
                Тип з\'єднання на виході: 6 "фланець
                Інформація для відвантаження
                
                Вага, кг: 508
                Відвантажувальні розміри, мм: 1800x710x970',
            'description_en' => 'Manufacturer: Western Rubber
                Country of origin: UNITED STATES
                Delivery time: 8-10 weeks
                Product information
                The 6WC drill swivel is designed for drilling large diameter water wells and construction wells. This swivel is very compact and has a 6 "(152mm) internal bore and can be used for both forward and reverse well circulation.
                
                Main advantages:
                
                - large bore 6 "(152 mm)
                - quick replacement of swivel seals
                - adjustable bearings and seals
                - 2 "NPT air tube connection
                Main technical parameters
                
                Length, mm: 1 524
                Through hole, mm: 152.4
                Max. Load during rotation, kg: 36
                Max static load, kg: 78.75
                Max pressure, kPa: 10 200
                Net weight, kg: 408
                Outlet connection type: 6 "flange
                Shipping Information
                
                Weight, kg: 508
                Shipping dimensions, mm: 1800x710x970',
            'cost' => '2345808.10',
            'currency' => 'USD',
            'region_encoded' => '9',
            'user_email' => 'alex.tarbeev@gmail.com',
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now()
        ]);

        DB::table('posts')->insert([
            'user_id' => 1,
            'thread' => 1,
            'origin_lang' => 'ru',
            'user_translations' => '{"title":[],"description":[]}',
            'title' => 'Трехшарошечное долото 76 мм (3") К-ЦА (IADC 743) Уралбурмаш',
            'title_uk' => 'Трьохшарошкове долото 76 мм (3") К-ЦА (IADC 743) Уралбурмаш',
            'title_en' => 'Three cone bit 76 mm (3") К-ЦА (IADC 743) Uralbyrmash',
            'type' => '2',
            'role' => '1',
            'condition' => 2,
            'tag_encoded' => '1.7',
            'description' => 'Страна происхождения:	РОССИЯ
                Производитель:	УралБурМаш
                Основные технические параметры
                
                Маркировка производителя:	A-C74Z-R1005
                Диаметр, мм (дюйм):	76 (3)
                Код IADC:	743
                Обозначение ГОСТ:	К-ЦА
                Тип горных пород:	крепкие породы
                Тип промывки:	центральная промывка
                Тип опорного подшипника:	два и более подшипников скольжения
                Тип опоры:	открытая
                Тип вооружения:	твердосплавное
                Состояние:	с хранения
                Осевая нагрузка, кН:	50-80
                Частота вращения, об/мин:	100-40
                Резьба API (ГОСТ):	З-42
                Вес нетто, кг:	1,8
                Информация для отгрузки
                
                Вес, кг:	2',
            'description_uk' => 'Країна походження: РОСІЯ
                Виробник: Уралбурмаш
                Основні технічні параметри
                
                Маркування виробника: A-C74Z-R1005
                Діаметр, мм (дюйм): 76 (3)
                Код IADC: 743
                Позначення ГОСТ: К-ЦА
                Тип гірських порід: міцні породи
                Тип промивання: центральна промивка
                Тип опорного підшипника: два і більше підшипників ковзання
                Тип опори: відкрита
                Тип озброєння: твердосплавне
                Стан: з зберігання
                Осьова навантаження, кН: 50-80
                Частота обертання, об / хв: 100-40
                Різьба API (ГОСТ): З-42
                Вага нетто, кг: 1,8
                Інформація для відвантаження
                
                Вага, кг: 2',
            'description_en' => 'Country of origin: RUSSIA
                Manufacturer: UralBurMash
                Main technical parameters
                
                Manufacturer part number: A-C74Z-R1005
                Diameter, mm (inch): 76 (3)
                IADC code: 743
                GOST designation: K-CA
                Rock type: hard rock
                Flush type: central flush
                Support bearing type: two or more plain bearings
                Support type: open
                Weapon type: carbide
                Condition: from storage
                Axial load, kN: 50-80
                Rotation frequency, rpm: 100-40
                API thread (GOST): З-42
                Net weight, kg: 1.8
                Shipping Information
                
                Weight, kg: 2',
            'user_email' => 'alex.tarbeev@gmail.com',
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now()
        ]);

        DB::table('users')->insert([
            'id' => 2,
            'name' => 'Pavel',
            'phone_raw' => '0000000000',
            'email' => 'pavlo.tarb@gmail.com',
            'email_verified_at' => Carbon\Carbon::now(),
            'password' => Hash::make('Pavel123'),
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now()
        ]);

        DB::table('posts')->insert([
            'user_id' => 2,
            'thread' => 1,
            'origin_lang' => 'uk',
            'user_translations' => '{"title":[],"description":[]}',
            'title' => 'Роторні клини',
            'title_ru' => 'Роторные клинья',
            'title_en' => 'Slips for rotary table',
            'type' => '1',
            'role' => '2',
            'condition' => 2,
            'tag_encoded' => '30.1',
            'description' => 'ТОВ “Бейкень енергетика Україна” продає  нові роторні клини для обсадної колони, бурильної труби, обваженої бурильної труби, сухарі для роторних клинів.

                У в наявності на складі нові:

                Роторні клини обсадної колони WG(CMS-XL) 5”, WG(CMS-XL) 20”;
                Роторні клини ТБТ 9” ~ 8-1/2”;
                Роторні клини УБТ WT(DCS-S) 3-1/2”, WT (DSC-R) 5-1/2” ~ 7”, Сухарі для роторних клинів УБТ 4 1/2”;
                Роторні клини БТ W(SDXL) 5”.',
            'description_ru' => 'ООО "Бейкень энергетика Украины" продает Новые роторные клинья для обсадной колонны, бурильнои трубы, утяжеленный бурильнои трубы, сухари для роторных Клин.

                В в наличии на складе Новые:

                Роторные клинья обсадной колонны WG (CMS-XL) 5 ", WG (CMS-XL) 20";
                Роторные клинья ТБТ 9 "~ 8-1 / 2";
                Роторные клинья УБТ WT (DCS-S) 3-1 / 2 ", WT (DSC-R) 5-1 / 2" ~ 7 ", Сухари для роторных Клин УБТ 4 1/2";
                Роторные клинья БТ W (SDXL) 5 ".',
            'description_en' => 'Baiken Energetika Ukraine LLC sells New rotary wedges for casing, drill pipe, weighted drill pipe, crackers for rotary wedges.

                In stock New:

                Rotary casing wedges WG (CMS-XL) 5 ", WG (CMS-XL) 20";
                Rotary wedges of TBT 9 "~ 8-1 / 2";
                Rotary wedges of UBT WT (DCS-S) 3-1 / 2 ", WT (DSC-R) 5-1 / 2" ~ 7 ", Rusks for rotary wedges of UBT 4 1/2";
                Rotary wedges BT W (SDXL) 5 ".',
            'user_email' => 'pavlo.tarbeiev@beiken.com',
            'user_phone_raw' => '0671859633',
            'region_encoded' => '16',
            'viber' => '1',
            'whatsapp' => '1',
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now()
        ]);

        DB::table('posts')->insert([
            'user_id' => 2,
            'thread' => 1,
            'origin_lang' => 'uk',
            'user_translations' => '{"title":[],"description":[]}',
            'title' => 'Лебідка та запчастини',
            'title_ru' => 'Лебедка и запчасти',
            'title_en' => 'Drawwork amd parts',
            'type' => '1',
            'role' => '2',
            'condition' => 2,
            'tag_encoded' => '26.4',
            'description' => 'ТОВ “Бейкень енергетика Україна” продає нові пневматичні лебідки 5т та запчастини для бурової лебідки.

                У в наявності на складі нові:

                Пневматична лебідка 5т;
                Тормозні колодки для бурової лебідки;
                Цеп бурової лебідки 254 576, цеп бурової лебідки 32S-2, цеп бурової лебідки 33S-4;
                Супорт в зборі DBS75-3-00.
                Більш детальну інформацію (сертифікати, паспорти і т. д.) ви можете отримати, надіславши запит за адресою електронної пошти або по телефону нижче.',
            'description_ru' => 'ООО "Бейкень энергетика Украины" продает новые пневматические лебедки 5т и запчасти для буровой лебедки.

                В в наличии на складе новые:

                Пневматическая лебедка 5т;
                Тормозные колодки для буровой лебедки;
                Цепь буровой лебедки 254576, цепь буровой лебедки 32S-2, цепь буровой лебедки 33S-4;
                Суппорт в сборе DBS75-3-00.
                Более подробную информацию (сертификаты, паспорта и т. Д.) Можно получить, отправив запрос по адресу электронной почты или по телефону ниже.',
            'description_en' => 'Baiken Energetika Ukraine LLC sells new 5t pneumatic winches and spare parts for drilling winches.

                In stock new:

                Pneumatic winch 5t;
                Brake pads for drilling winch;
                Drilling winch chain 254 576, drilling winch chain 32S-2, drilling winch chain 33S-4;
                Support assembly DBS75-3-00.
                You can get more detailed information (certificates, passports, etc.) by sending an inquiry by e-mail or by phone below.',
                'user_email' => 'pavlo.tarbeiev@beiken.com',
            'user_phone_raw' => '0671859633',
            'region_encoded' => '16',
            'town' => 'Полтава',
            'viber' => '1',
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now()
        ]);

        DB::table('users')->insert([
            'id' => 3,
            'name' => 'Dmitriy',
            'phone_raw' => '0000000000',
            'email' => 'dmytro.tarbeiev@gmail.com',
            'email_verified_at' => Carbon\Carbon::now(),
            'password' => Hash::make('Dmitriy123'),
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now()
        ]);

        DB::table('posts')->insert([
            'user_id' => 3,
            'thread' => 1,
            'origin_lang' => 'ru',
            'user_translations' => '{"title":[],"description":[]}',
            'title' => 'Метчик ловильный B',
            'title_uk' => 'Метчик ловильный B',
            'title_en' => 'Fishing pike B',
            'type' => '3',
            'role' => '1',
            'condition' => 4,
            'tag_encoded' => '14.3.3',
            'description' => 'Страна происхождения:	РОССИЯ
                Cрок поставки:	10 дней
                Основные технические параметры
                
                Диаметр захватываемого инструмента, мм:	20-57
                Минимальный диаметр скважины, мм:	70
                Резьба:	З-50
                Направление резьбы:	правое
                Промывочное отверстие:	нет
                Резьба ГОСТ:	З-50
                Резьба API 7-1 (ГОСТ):	З-50
                Резьба API (ГОСТ):	З-50',
            'description_uk' => 'Країна походження: РОСІЯ
                Термін поставки: 10 днів
                Основні технічні параметри
            
                Діаметр захоплюваного інструменту, мм: 20-57
                Мінімальний діаметр свердловини, мм: 70
                Різьблення: З-50
                Напрямок різьблення: праве
                Промивальне отвір: немає
                Різьба ГОСТ: З-50
                Різьба API 7-1 (ГОСТ): З-50
                Різьба API (ГОСТ): З-50',
            'description_en' => 'Country of origin: RUSSIA
                Delivery time: 10 days
                Main technical parameters
            
                Gripped tool diameter, mm: 20-57
                Minimum hole diameter, mm: 70
                Thread: З-50
                Thread direction: right
                Flushing hole: no
                GOST thread: З-50
                Thread API 7-1 (GOST): З-50
                API thread (GOST): З-50',
            'cost' => '7105.49',
            'currency' => 'UAH',
            'user_email' => 'dmytro.tarbeiev@gmail.com',
            'user_phone_raw' => '0521345442',
            'region_encoded' => '10',
            'viber' => '1',
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now()
        ]);

        DB::table('posts')->insert([
            'user_id' => 3,
            'thread' => 1,
            'origin_lang' => 'ru',
            'user_translations' => '{"title":[],"description":[]}',
            'title' => 'Скважинная камера TEL1, кабель 300 м',
            'title_uk' => 'Скважинна камера TEL1, кабель 300 м',
            'title_en' => 'Well camera TEL1, cabel 300 м',
            'type' => '3',
            'role' => '2',
            'condition' => 2,
            'tag_encoded' => '6.2.1',
            'description' => 'Камера TEL 1 предназначена для исследования скважины в процессе бурения. Камера TEL 1 является легким, простым в использовании и очень надежным инструментом для использования в буровых условиях.
                Полный комплект состоит из: катушки, камеры, монитора с LCD дисплеем, USB выхода и входа для микрофона для записи видео и звука на любой ноутбук.

                МОБИЛЬНОСТЬ
                ЛЕГКОСТЬ ИСПОЛЬЗОВАНИЯ
                ВЫСОКАЯ НАДЕЖНОСТЬ
                ВОДОНЕПРОНИЦАЕМОСТЬ ДО 35 АТМ.
                ВЫСОКОЕ КАЧЕСТВО СЪЕМКИ
                Основные технические параметры

                Глубина использования, м:	350
                Диаметр камеры, мм:	40
                Длина камеры, мм:	150
                Длина кабеля, м:	300
                Гарантия:	1 год
                Вес нетто, кг:	15
                Информация для отгрузки

                Вес, кг:	20',
            'description_uk' => 'Камера TEL 1 призначена для дослідження свердловини в процесі буріння. Камера TEL 1 є легким, простим у використанні і дуже надійним інструментом для використання в бурових умовах.
                Повний комплект складається з: котушки, камери, монітора з LCD дисплеєм, USB виходу і входу для мікрофона для запису відео та звуку на будь-який ноутбук.

                МОБІЛЬНІСТЬ
                ЛЕГКІСТЬ ВИКОРИСТАННЯ
                ВИСОКА НАДІЙНІСТЬ
                ВОДОНЕПРОНИКНІСТЬ ДО 35 АТМ.
                Найвища якість ЗЙОМКИ
                Основні технічні параметри

                Глибина використання, м: 350
                Діаметр камери, мм: 40
                Довжина камери, мм: 150
                Довжина кабелю, м: 300
                Гарантія: 1 рік
                Вага нетто, кг: 15
                Інформація для відвантаження

                Вага, кг: 20',
            'description_en' => 'The TEL 1 camera is designed to survey a well while drilling. The TEL 1 camera is a lightweight, easy-to-use and highly reliable tool for use in drilling environments.
                The complete set consists of: coil, camera, monitor with LCD display, USB output and microphone input for recording video and sound on any laptop.

                MOBILITY
                EASY TO USE
                HIGH RELIABILITY
                WATER RESISTANCE UP TO 35 ATM.
                HIGH QUALITY SHOOTING
                Main technical parameters

                Depth of use, m: 350
                Chamber diameter, mm: 40
                Chamber length, mm: 150
                Cable length, m: 300
                Warranty: 1 year
                Net weight, kg: 15
                Shipping Information

                Weight, kg: 20',
            'cost' => '620153.70',
            'currency' => 'UAH',
            'user_email' => 'dmytro.tarbeiev@gmail.com',
            'user_phone_raw' => '0521345442',
            'viber' => '1',
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now()
        ]);

        DB::table('users')->insert([
            'id' => 4,
            'name' => 'Yaroslav',
            'phone_raw' => '1234567890',
            'telegram' => '1',
            'email' => 'yarikmoklyak2010@gmail.com',
            'email_verified_at' => Carbon\Carbon::now(),
            'password' => Hash::make('Yarik1'),
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now()
        ]);

        DB::table('posts')->insert([
            'user_id' => 4,
            'thread' => 1,
            'origin_lang' => 'ru',
            'user_translations' => '{"title":[],"description":[]}',
            'title' => 'Верхний привод FHD 6-23 R 1/4/8',
            'title_uk' => 'Верхній привід FHD 6-23 R 1/4/8',
            'title_en' => 'Top Drive System FHD 6-23 R 1/4/8',
            'type' => '1',
            'role' => '1',
            'condition' => 2,
            'tag_encoded' => '21.3',
            'description' => 'Страна происхождения:	ГЕРМАНИЯ
                Cрок поставки:	20-24 недель
                Информация о товаре
                
                Верхний привод FHD 6-23 R 1/4/8 предназначен для бурения скважин большого диаметра как с прямой, так и обратной циркуляцией бурового раствора. Может монтироваться на отечественные роторные буровые установки, тем самым позволяет значительно увеличить производительность бурения за счет сокращения времени на спуско-подъемные операции, а также увеличения скорости бурения.
                
                Верхний привод подключается к гидросистеме буровой установки, может отклоняться на 90 градусов вперед для удобства подъема буровых и труб и УБТ со стеллажей, а также откидываться на 180 градусов в сторону, для освобождения устья скважина при спуске обсадных труб. Все манипуляции осуществляются с помощью гидравлики с пульта бурильщика.
                Основные технические параметры
                
                Проходное отверстие, мм:	150
                Макс.нагрузка при вращении, кг:	50 000
                Макс.давление, кПа:	4 000
                Максимальный крутящий момент, Нм:	26 000
                Максимальная частота вращения, об/мин:	230
                Вес нетто, кг:	850
                Гарантия:	1 год
                Информация для отгрузки
                
                Вес, кг:	900',
            'description_uk' => 'Країна походження: НІМЕЧЧИНА
                Термін поставки: 20-24 тижнів
                Інформація про товар
                
                Верхній привід FHD 6-23 R 1/4/8 призначений для буріння свердловин великого діаметру як з прямою, так і зворотної циркуляцією бурового розчину. Може монтуватися на вітчизняні роторні бурові установки, тим самим дозволяє значно збільшити продуктивність буріння за рахунок скорочення часу на спуско-підйомні операції, а також збільшення швидкості буріння.
                
                Верхній привід підключається до гідросистемі бурової установки, може відхилятися на 90 градусів вперед для зручності підйому бурових і труб і УБТ зі стелажів, а також відкидатися на 180 градусів в сторону, для звільнення гирла свердловина при спуску обсадних труб. Всі маніпуляції здійснюються за допомогою гідравліки з пульта бурильника.
                Основні технічні параметри
                
                Прохідний отвір, мм: 150
                Макс.нагрузка при обертанні, кг: 50 000
                Макс.давленіе, кПа: 4 000
                Максимальний крутний момент, Нм: 26 000
                Максимальна частота обертання, об / хв: 230
                Вага нетто, кг: 850
                Гарантія: 1 рік
                Інформація для відвантаження
                
                Вага, кг: 900',
            'description_en' => 'Country of origin: GERMANY
                Delivery time: 20-24 weeks
                Product information
                
                The FHD 6-23 R 1/4/8 top drive is designed for drilling large-diameter wells with both direct and reverse circulation of drilling mud. It can be mounted on domestic rotary drilling rigs, thereby significantly increasing drilling productivity by reducing the time for round-trip operations, as well as increasing the drilling speed.
                
                The top drive is connected to the hydraulic system of the drilling rig, can be tilted 90 degrees forward for easy lifting of drill pipes and drill collars from the racks, as well as tilted 180 degrees to the side to free the wellhead when running casing pipes. All manipulations are carried out using hydraulics from the driller\'s console.
                Main technical parameters
                
                Through hole, mm: 150
                Max. Load during rotation, kg: 50 000
                Max pressure, kPa: 4000
                Maximum torque, Nm: 26,000
                Maximum speed, rpm: 230
                Net weight, kg: 850
                Warranty: 1 year
                Shipping Information
                
                Weight, kg: 900',
            'cost' => '2338242.07',
            'currency' => 'UAH',
            'user_email' => 'yarikmoklyak2010@gmail.com',
            'user_phone_raw' => '1234567890',
            'telegram' => '1',
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now()
        ]);

        DB::table('posts')->insert([
            'user_id' => 4,
            'thread' => 1,
            'origin_lang' => 'ru',
            'user_translations' => '{"title":[],"description":[]}',
            'title' => 'Плунжерный насос Wheatley T365-AM (59T-3M), новый',
            'title_uk' => 'Плунжерный насос Wheatley T365-AM (59T-3M), новый',
            'title_ru' => 'Plunger pump Wheatley T365-AM (59T-3M), new',
            'type' => '1',
            'role' => '1',
            'condition' => 1,
            'tag_encoded' => '4.5',
            'description' => 'Производитель:	NOV
                Страна происхождения:	СОЕДИНЕННЫЕ ШТАТЫ
                Cрок поставки:	14-16 недель
                Основные технические параметры
                
                Расчетная мощность, кВт:	44 кВт при 420 об/мин
                Максимальная производительность, л/мин:	354,6
                Тип клапанов:	Дисковые
                Направление вращения:	правое
                Резьба на всасывании:	2 1/2" NPT
                Резьба на подаче:	2" NPT
                Максимальный размер плунжера, мм:	63,5
                Ход плунжера, мм:	88,9
                Количество плунжеров:	3
                Расчетная нагрузка на плунжер, кг:	2159
                Макс.давление, кПа:	15 825
                Выход на привод:	шпоночный вал
                Привод:	без привода
                Гарантия:	2 года
                Размеры без упаковки, мм:	1024х763х454
                Вес нетто, кг:	445
                Размер на всасывании:	2 1/2" NPT
                Размер на подаче:	2" NPT
                Информация для отгрузки
                
                Вес, кг:	500
                Отгрузочные размеры, мм:	1200x800x500',
            'description_uk' => 'Виробник: NOV
                Країна походження: СПОЛУЧЕНИХ ШТАТІВ
                Термін поставки: 14-16 тижнів
                Основні технічні параметри
                
                Розрахункова потужність, кВт: 44 кВт при 420 об / хв
                Максимальна продуктивність, л / хв: 354,6
                Тип клапанів: Дискові
                Напрямок обертання: праве
                Різьба на всмоктуванні: 2 1/2 "NPT
                Різьба на подачі: 2 "NPT
                Максимальний розмір плунжера, мм: 63,5
                Хід плунжера, мм: 88,9
                Кількість плунжеров: 3
                Розрахункове навантаження на плунжер, кг: 2159
                Макс.давленіе, кПа: 15, 825
                Вихід на привід: шпонковий вал
                Привід: без приводу
                Гарантія: 2 роки
                Розміри без упаковки, мм: 1024х763х454
                Вага нетто, кг: 445
                Розмір на всмоктуванні: 2 1/2 "NPT
                Розмір на подачі: 2 "NPT
                Інформація для відвантаження
                
                Вага, кг: 500
                Відвантажувальні розміри, мм: 1200x800x500',
            'description_en' => 'Manufacturer: NOV
                Country of origin: UNITED STATES
                Delivery time: 14-16 weeks
                Main technical parameters
                
                Design power, kW: 44 kW at 420 rpm
                Maximum productivity, l / min: 354.6
                Valve type: Disc
                Direction of rotation: right
                Suction thread: 2 1/2 "NPT
                Inlet thread: 2 "NPT
                Maximum plunger size, mm: 63.5
                Plunger stroke, mm: 88.9
                Number of plungers: 3
                Estimated load on the plunger, kg: 2159
                Max pressure, kPa: 15,825
                Drive output: key shaft
                Drive: no drive
                Warranty: 2 years
                Dimensions without packaging, mm: 1024х763х454
                Net weight, kg: 445
                Suction size: 2 1/2 "NPT
                Delivery Size: 2 "NPT
                Shipping Information
                
                Weight, kg: 500
                Shipping dimensions, mm: 1200x800x500',
            'cost' => '1209378.72',
            'currency' => 'UAH',
            'user_email' => 'yarikmoklyak2010@gmail.com',
            'user_phone_raw' => '1234567890',
            'telegram' => '1',
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now()
        ]);

        /*
        // Long Data Test

        DB::table('users')->insert([
            'id' => 4,
            'name' => 'Extra long user name tttt t ttt tt ttttt',
            'email' => 'ExtraLongUserEmailtttttttttttttttttttttttytttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttt@mail.ru',
            'email_verified_at' => Carbon\Carbon::now(),
            'phone_raw' => '12312312312312312331',
            'viber' => '1',
            'telegram' => '1',
            'whatsapp' => '1',
            'password' => Hash::make('Qwerty1')
        ]);

        DB::table('posts')->insert([
            'user_id' => 4,
            'thread' => 1,
            'origin_lang' => 'ru',
            'user_translations' => '{"title":[],"description":[]}',
            'title' => 'Extra long post title tttttttttttttt t t t tttttt t tttttt tttttt tttt',
            'condition' => 'Новое',
            'tag_encoded' => '31.1',
            'description' => 'Am of mr friendly by strongly peculiar juvenile. Unpleasant it sufficient simplicity am by friendship no inhabiting. Goodness doubtful material has denoting suitable she two. Dear mean she way and poor bred they come. He otherwise me incommode explained so in remaining. Polite barton in it warmly do county length an. 

                Demesne far hearted suppose venture excited see had has. Dependent on so extremely delivered by. Yet ﻿no jokes worse her why. Bed one supposing breakfast day fulfilled off depending questions. Whatever boy her exertion his extended. Ecstatic followed handsome drawings entirely mrs one yet outweigh. Of acceptance insipidity remarkably is invitation. 
                
                Is post each that just leaf no. He connection interested so we an sympathize advantages. To said is it shed want do. Occasional middletons everything so to. Have spot part for his quit may. Enable it is square my an regard. Often merit stuff first oh up hills as he. Servants contempt as although addition dashwood is procured. Interest in yourself an do of numerous feelings cheerful confined. 
                
                Or neglected agreeable of discovery concluded oh it sportsman. Week to time in john. Son elegance use weddings separate. Ask too matter formed county wicket oppose talent. He immediate sometimes or to dependent in. Everything few frequently discretion surrounded did simplicity decisively. Less he year do with no sure loud. 
                
                Left till here away at to whom past. Feelings laughing at no wondered repeated provided finished. It acceptance thoroughly my advantages everything as. Are projecting inquietude affronting preference saw who. Marry of am do avoid ample as. Old disposal followed she ignorant desirous two has. Called played entire roused though for one too. He into walk roof made tall cold he. Feelings way likewise addition wandered contempt bed indulged. 
                
                Building mr concerns servants in he outlived am breeding. He so lain good miss when sell some at if. Told hand so an rich gave next. How doubt yet again see son smart. While mirth large of on front. Ye he greater related adapted proceed entered an. Through it examine express promise no. Past add size game cold girl off how old. 
                
                Do in laughter securing smallest sensible no mr hastened. As perhaps proceed in in brandon of limited unknown greatly. Distrusts fulfilled happiness unwilling as explained of difficult. No landlord of peculiar ladyship attended if contempt ecstatic. Loud wish made on is am as hard. Court so avoid in plate hence. Of received mr breeding concerns peculiar securing landlord. Spot to many it four bred soon well to. Or am promotion in no departure abilities. Whatever landlord yourself at by pleasure of children be. 
                
                It sportsman earnestly ye preserved an on. Moment led family sooner cannot her window pulled any. Or raillery if improved landlord to speaking hastened differed he. Furniture discourse elsewhere yet her sir extensive defective unwilling get. Why resolution one motionless you him thoroughly. Noise is round to in it quick timed doors. Written address greatly get attacks inhabit pursuit our but. Lasted hunted enough an up seeing in lively letter. Had judgment out opinions property the supplied. 
                
                Ignorant branched humanity led now marianne too strongly entrance. Rose to shew bore no ye of paid rent form. Old design are dinner better nearer silent excuse. She which are maids boy sense her shade. Considered reasonable we affronting on expression in. So cordial anxious mr delight. Shot his has must wish from sell nay. Remark fat set why are sudden depend change entire wanted. Performed remainder attending led fat residence far. 
                
                Depart do be so he enough talent. Sociable formerly six but handsome. Up do view time they shot. He concluded disposing provision by questions as situation. Its estimating are motionless day sentiments end. Calling an imagine at forbade. At name no an what like spot. Pressed my by do affixed he studied. 
                
                Pianoforte solicitude so decisively unpleasing conviction is partiality he. Or particular so diminution entreaties oh do. Real he me fond show gave shot plan. Mirth blush linen small hoped way its along. Resolution frequently apartments off all discretion devonshire. Saw sir fat spirit seeing valley. He looked or valley lively. If learn woody spoil of taken he cause. 
                
                Oh he decisively impression attachment friendship so if everything. Whose her enjoy chief new young. Felicity if ye required likewise so doubtful. On so attention necessary at by provision otherwise existence direction. Unpleasing up announcing unpleasant themselves oh do on. Way advantage age led listening belonging supposing. 
                
                Necessary ye contented newspaper zealously breakfast he prevailed. Melancholy middletons yet understood decisively boy law she. Answer him easily are its barton little. Oh no though mother be things simple itself. Dashwood horrible he strictly on as. Home fine in so am good body this hope. 
                
                Letter wooded direct two men indeed income sister. Impression up admiration he by partiality is. Instantly immediate his saw one day perceived. Old blushes respect but offices hearted minutes effects. Written parties winding oh as in without on started. Residence gentleman yet preserved few convinced. Coming regret simple longer little am sister on. Do danger in to adieus ladies houses oh eldest. Gone pure late gay ham. They sigh were not find are rent. 
                
                So by colonel hearted ferrars. Draw from upon here gone add one. He in sportsman household otherwise it perceived instantly. Is inquiry no he several excited am. Called though excuse length ye needed it he having. Whatever throwing we on resolved entrance together graceful. Mrs assured add private married removed believe did she. 
                
                Attachment apartments in delightful by motionless it no. And now she burst sir learn total. Hearing hearted shewing own ask. Solicitude uncommonly use her motionless not collecting age. The properly servants required mistaken outlived bed and. Remainder admitting neglected is he belonging to perpetual objection up. Has widen too you decay begin which asked equal any. 
                
                Of on affixed civilly moments promise explain fertile in. Assurance advantage belonging happiness departure so of. Now improving and one sincerity intention allowance commanded not. Oh an am frankness be necessary earnestly advantage estimable extensive. Five he wife gone ye. Mrs suffering sportsmen earnestly any. In am do giving to afford parish settle easily garret. 
                
                Performed suspicion in certainty so frankness by attention pretended. Newspaper or in tolerably education enjoyment. Extremity excellent certainty discourse sincerity no he so resembled. Joy house worse arise total boy but. Elderly up chicken do at feeling is. Like seen drew no make fond at on rent. Behaviour extremely her explained situation yet september gentleman are who. Is thought or pointed hearing he. 
                
                Sex and neglected principle ask rapturous consulted. Object remark lively all did feebly excuse our wooded. Old her object chatty regard vulgar missed. Speaking throwing breeding betrayed children my to. Me marianne no he horrible produced ye. Sufficient unpleasing an insensible motionless if introduced ye. Now give nor both come near many late. 
                
                Was certainty remaining engrossed applauded sir how discovery. Settled opinion how enjoyed greater joy adapted too shy. Now properly surprise expenses interest nor replying she she. Bore tall nay many many time yet less. Doubtful for answered one fat indulged margaret sir shutters together. Ladies so in wholly around whence in at. Warmth he up giving oppose if. Impossible is dissimilar entreaties oh on terminated. Earnest studied article country ten respect showing had. But required offering him elegance son improved informed. 
                
                View fine me gone this name an rank. Compact greater and demands mrs the parlors. Park be fine easy am size away. Him and fine bred knew. At of hardly sister favour. As society explain country raising weather of. Sentiments nor everything off out uncommonly partiality bed. 
                
                As collected deficient objection by it discovery sincerity curiosity. Quiet decay who round three world whole has mrs man. Built the china there tried jokes which gay why. Assure in adieus wicket it is. But spoke round point and one joy. Offending her moonlight men sweetness see unwilling. Often of it tears whole oh balls share an. 
                
                Is at purse tried jokes china ready decay an. Small its shy way had woody downs power. To denoting admitted speaking learning my exercise so in. Procured shutters mr it feelings. To or three offer house begin taken am at. As dissuade cheerful overcame so of friendly he indulged unpacked. Alteration connection to so as collecting me. Difficult in delivered extensive at direction allowance. Alteration put use diminution can considered sentiments interested discretion. An seeing feebly stairs am branch income me unable. 
                
                To they four in love.',
            'user_email' => 'ExtraLongUserEmailtttttttttttttttttttttttytttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttt@mail.ru',
            'user_phone_raw' => '12312312312312312331',
            'viber' => '1',
            'telegram' => '1',
            'whatsapp' => '1'
        ]);
        */
    }
}
