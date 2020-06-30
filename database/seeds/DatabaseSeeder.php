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
        // Seed for Demonstrating To Production 
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'Administrator',
            'phone' => '0000000000',
            'email' => 'alex.tarbeev@gmail.com',
            'email_verified_at' => Carbon\Carbon::now(),
            'password' => Hash::make('Admin1')
        ]);

        DB::table('posts')->insert([
            'user_id' => 1,
            'title' => 'Тест Заголовок На Русском DEMO',
            'condition' => 'Б/У',
            'tag' => 'Бур. колонна и оборудывание, Подземное, Трубы',
            'description' => 'Только Для Демонстрации
                Пример Описания
                DEMO
                .',
            'cost' => '000000 руб',
            'location' => 'Украина',
            'user_email' => 'dummy.email@example.com',
            'user_phone' => '000000000',
            'viber' => '1',
            'telegram' => '1',
            'whatsapp' => '1'
        ]);

        DB::table('posts')->insert([
            'user_id' => 1,
            'title' => 'Тест Заловку На Українській DEMO',
            'condition' => 'Новое',
            'tag' => 'КНБК, Наземное, Клинья',
            'description' => 'Тільки у Демонстраційних цілях
                Приклад Опису
                DEMO
                .',
            'cost' => '000000 грн',
            'location' => 'Україна',
            'user_email' => 'dummy.email@example.com',
            'user_phone' => '000000000',
            'viber' => '1',
            'telegram' => '1',
            'whatsapp' => '1'
        ]);

        DB::table('posts')->insert([
            'user_id' => 1,
            'title' => 'Test Title In English DEMO',
            'condition' => 'Новое',
            'tag' => 'Буровой раствор, Циркуляция, Шланги',
            'description' => 'Demonstrationg Purposes Only
                Sample Description
                DEMO
                .',
            'cost' => '000000 $',
            'location' => 'Ukraine',
            'user_email' => 'dummy.email@example.com',
            'user_phone' => '000000000',
            'viber' => '1',
            'telegram' => '1',
            'whatsapp' => '1'
        ]);

        DB::table('posts')->insert([
            'user_id' => 1,
            'title' => 'Заголовок. Пустое Обьявление 1',
            'condition' => 'Новое',
            'tag' => 'Другое',
            'description' => 'Описание. Пустое Обьявление 1
                ----',
            'user_email' => 'dummy.email@example.com'
        ]);
        DB::table('posts')->insert([
            'user_id' => 1,
            'title' => 'Заголовок. Пустое Обьявление 2',
            'condition' => 'Новое',
            'tag' => 'Другое',
            'description' => 'Описание. Пустое Обьявление 2
                ----',
            'user_email' => 'dummy.email@example.com'
        ]);
        DB::table('posts')->insert([
            'user_id' => 1,
            'title' => 'Заголовок. Пустое Обьявление 3',
            'condition' => 'Новое',
            'tag' => 'Другое',
            'description' => 'Описание. Пустое Обьявление 3
                ----',
            'user_email' => 'dummy.email@example.com'
        ]);
        DB::table('posts')->insert([
            'user_id' => 1,
            'title' => 'Заголовок. Пустое Обьявление 4',
            'condition' => 'Новое',
            'tag' => 'Другое',
            'description' => 'Описание. Пустое Обьявление 4
                ----',
            'user_email' => 'dummy.email@example.com'
        ]);
        DB::table('posts')->insert([
            'user_id' => 1,
            'title' => 'Заголовок. Пустое Обьявление 5',
            'condition' => 'Новое',
            'tag' => 'Другое',
            'description' => 'Описание. Пустое Обьявление 5
                ----',
            'user_email' => 'dummy.email@example.com'
        ]);


        /*
        // Seed For Development
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'admin',
            'phone' => '0502115147',
            'email' => 'alex.tarbeev@gmail.com',
            'email_verified_at' => Carbon\Carbon::now(),
            'password' => Hash::make('Admin1')
        ]);

        DB::table('users')->insert([
            'id' => 3,
            'name' => 'Dummy User',
            'email' => 'dummy.email@example.ua',
            'email_verified_at' => Carbon\Carbon::now(),
            'password' => Hash::make('Qwerty1')
        ]);

        // $this->call(UserSeeder::class);
        factory('App\Post', 10)->create();

        DB::table('users')->insert([
            'id' => 2,
            'name' => 'Drill Market',
            'phone' => '8 495 095-05-97',
            'email' => 'drill.market@mail.ru',
            'email_verified_at' => Carbon\Carbon::now(),
            'password' => Hash::make('Qwerty1')
        ]);

        DB::table('posts')->insert([
            'user_id' => 2,
            'title' => 'Буровая штанга 89х6,5х1000 мм, резьба З-73',
            'condition' => 'Новое',
            'tag' => 'Бур. колонна и оборудывание, Подземное, Трубы',
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
            'cost' => '5 148.00 руб / 1 шт',
            'user_email' => 'drill.market@mail.ru',
            'user_phone' => '8 495 095-05-97'
        ]);

        DB::table('posts')->insert([
            'user_id' => 2,
            'title' => 'Вертлюг 6WC',
            'condition' => 'Новое',
            'tag' => 'Роторная система, Вертлюг',
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
            'cost' => '2 345 808.10 руб',
            'location' => 'Москва',
            'user_email' => 'drill.market@mail.ru',
        ]);

        DB::table('posts')->insert([
            'user_id' => 2,
            'title' => 'Трехшарошечное долото 76 мм (3") К-ЦА (IADC 743) Уралбурмаш',
            'condition' => 'Новое',
            'tag' => 'КНБК, Подземное, Породоразрущающий инструмент, Долото, Шарошечное',
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
            'user_email' => 'drill.market@mail.ru',
        ]);

        DB::table('users')->insert([
            'id' => 4,
            'name' => 'Extra long user name tttt t ttt tt ttttt',
            'email' => 'ExtraLongUserEmailtttttttttttttttttttttttytttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttt@mail.ru',
            'email_verified_at' => Carbon\Carbon::now(),
            'phone' => '12312312312312312331',
            'viber' => '1',
            'telegram' => '1',
            'whatsapp' => '1',
            'password' => Hash::make('Qwerty1')
        ]);

        DB::table('posts')->insert([
            'user_id' => 4,
            'title' => 'Extra long post title tttttttttttttt t t t tttttt t tttttt tttttt tttt',
            'condition' => 'Новое',
            'tag' => 'КНБК, Подземное, Породоразрущающий инструмент, Долото, Шарошечное',
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
            'user_phone' => '12312312312312312331',
            'viber' => '1',
            'telegram' => '1',
            'whatsapp' => '1'
        ]);
        */
    }
}
