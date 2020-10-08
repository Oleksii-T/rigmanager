<?php
  
// custom loc_url helpers for using in blade template
if (! function_exists('loc_url')) {
    /**
     * Return URL with lang prefix to slug
     */
    function loc_url($slug)
    {
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