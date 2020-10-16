<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Google\Cloud\Translate\TranslateClient;
use Illuminate\Support\Facades\Log;

class TranslatePost implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 2;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 30;

    protected $shouldUpdate;
    protected $post;
    protected $input;
    protected $role;
    protected $translateTo;
    protected $translator;
    protected $result;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(\App\Post $post, $input, $role)
    {
        $this->shouldUpdate = false; // flag signals that some translation was done
        $this->post = $post; //the post
        unset($input['images']);
        $this->input = $input;
        $this->role = $role;
        $appLanguages = collect(['uk', 'ru', 'en']); //all available languages for this App
        $this->translateTo = $appLanguages->forget( $appLanguages->search($input['origin_lang']) ); // exclude the origin language from all languages available for App
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->translator = new TranslateClient(['key' => env('GCP_KEY')]); // object of translation provider
        if ( $this->role ) {
            $this->translateNewPost();
        } else {
            $this->translateOldPost();
        }
    }

    //And other testing. Now it is English version
    //Description changed as well!

    //я поміняв заголовок з анлійского на українській
    //і опис теж тепер українською

    //на українській
    //на русском
    private function translateOldPost() {
        // if origin language is changed, delete useless translation records,
        if ( $this->input['origin_lang'] != $this->input['origin_lang_old'] ) {
            $this->result['title_'.$this->input['origin_lang']] = null;
            $this->result['description_'.$this->input['origin_lang']] = null;
            $this->shouldUpdate = true;
        }
        // translate to each language but not to origin one
        foreach ($this->translateTo as $lang) {
            if ( $this->input['origin_lang'] != $this->input['origin_lang_old'] || $this->input['title'] != $this->input['title_old'] || $this->input['user_translations']['title'] != $this->input['user_translations_old']['title'] ) { // if origin language was changed OR title was changed OR user changed allowed to translate languages
                if ( array_key_exists($lang, $this->input['title_translate']) || ( !array_key_exists($lang, $this->input['title_translate']) && !$this->input['title_'.$lang] ) ) { // if lang is in title_translate array OR lang in not in title_translate array AND title_lang is empty
                    $this->translate('title_'.$lang, $this->input['title'], $lang);// add new translation record
                }
            }
            if ( $this->input['origin_lang'] != $this->input['origin_lang_old'] || $this->input['description'] != $this->input['description_old'] || $this->input['user_translations']['description'] != $this->input['user_translations_old']['description'] ) {
                if ( array_key_exists($lang,  $this->input['desc_translate']) || ( !array_key_exists($lang, $this->input['desc_translate']) && !$this->input['description_'.$lang] ) ) {
                    $this->translate('description_'.$lang, $this->input['description'], $lang);// add new translation record
                }
            }
        }
        if ( $this->shouldUpdate ) {
            $this->post->update($this->result);
        }
    }

    private function translateNewPost() {
        // translate to each language but not to origin one
        foreach ($this->translateTo as $lang) {
            $column = 'title_'.$lang;
            if ( !$this->post->$column ) {
                $this->translate($column, $this->input['title'], $lang);
            }
            $column = 'description_'.$lang;
            if ( !$this->post->$column ) {
                $this->translate($column, $this->input['description'], $lang);
            }
        }
        if ( $this->shouldUpdate ) {
            $this->post->update($this->result);
        }
    }

    private function translate ($column, $text, $lang) {
        // check is the translation column is empty (if it is not, it means that user made manual translation)
        try {
            $translated = $this->translator->translate($text, ['target' => $lang])['text'];
            // escape special chars
            $translated = str_replace('&amp;', '&', $translated);
            $translated = str_replace('&quot;', '"', $translated);
            $translated = str_replace('&#39;', '\'', $translated);
            $translated = str_replace('&lt;', '<', $translated);
            $translated = str_replace('&gt;', '>', $translated);
            $this->result[$column] = $translated;
            $this->shouldUpdate = true;
        } catch (\Throwable $th) {
            Log::channel('single')->error('[custom.error][post.translate] Post translation error. ('.$this->originLang.'->'.$lang.') '.$th->getMessage());
        }
    }
}