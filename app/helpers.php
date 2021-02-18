<?php
  
// custom loc_url helpers for using in blade template
if ( !function_exists('loc_url') ) {
    /**
     * Return URL with lang prefix to slug
     */
    function loc_url($slug) {
        $locale = app()->getLocale();
        if (!$locale) {
            return $slug;
        }

        // parse home route
        if($slug === route('home')) {
            return $locale === 'uk' ? $slug : $slug.'/'.$locale;
        }
        //parse other routes
        if ($locale === 'uk') {
            return $slug;
        }
        $base = route('home');
        $slug = str_replace($base, "", $slug);
        $slug = $base . '/' . $locale . $slug;
        return $slug;
    }
}

// convert string in "UK" or "RU" to transiterated version of "EN"
if ( !function_exists('transliteration') )  {
    function transliteration($str, $check) {
        $converter = array(
            'а' => 'a',   'б' => 'b',   'в' => 'v',
            'г' => 'g',   'д' => 'd',   'е' => 'e',
            'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
            'и' => 'i',   'й' => 'y',   'к' => 'k',
            'л' => 'l',   'м' => 'm',   'н' => 'n',
            'о' => 'o',   'п' => 'p',   'р' => 'r',
            'с' => 's',   'т' => 't',   'у' => 'u',
            'ф' => 'f',   'х' => 'h',   'ц' => 'c',
            'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
            'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
            'э' => 'e',   'ю' => 'yu',  'я' => 'ya',

            'і' => 'i',   'є' => 'ye',   'ї' => 'yi'
        );
        $t = mb_strtolower($str); // transform to lower case
        $t = strtr($t, $converter); // convert to transliteration
        $t = str_replace(' ', '-', $t); //change all spaces to hyphens
        $t = preg_replace('~[^a-z0-9-]+~ui', '', $t); //remova all special chars
        $t = preg_replace('/-+/', '-', $t); // remove all double hyphens
        $t = trim($t, "-"); //remove hyphens from end and begining
        $t = mb_substr($t, 0, 40); // cut to 40 length
        $t = trim($t, "-"); //remove hyphens from end and begining
        // generage random sufix to prevent same urls
        if (in_array($t, $check)) {
            while(true) {
                $rand = mb_strtolower(Str::random(3));
                if (!in_array($t.'-'.$rand, $check)) {
                    $t = $t.'-'.$rand;
                    break;
                }
            }
        }
        return $t;
    }
}

//format number to cost
if ( !function_exists('formatNumberToCost') ) {
    function formatNumberToCost($number, $currency) {
        $cost = strval($number);
        $coins = strstr($cost, '.');
        if (!$coins) {
            $cost = $cost.".00";
        }
        else if (strlen($coins) != 3 ) {
            $cost = $cost."0";
        }
        $step = 1;
        $commaIndexes = array();
        for ($i=strlen($cost)-4; $i > 0 ; $i--) {
            if ($step == 3) {
                $commaIndexes[] = $i;
                $step = 1;
            } else {
                $step++;
            }
        }
        foreach ($commaIndexes as $commaIndex) {
            $cost = substr_replace($cost, ',', $commaIndex, 0);
        }
        $c = $currency=="UAH" ? '₴' : '$' ;
        return substr_replace($cost, $c, 0, 0);
    }
}