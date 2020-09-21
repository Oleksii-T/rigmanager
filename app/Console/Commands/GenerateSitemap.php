<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Illuminate\Support\Facades\Log;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            Sitemap::create()
                ->add(Url::create('/')
                    ->setLastModificationDate(\Carbon\Carbon::now())
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority(0.8))
                ->add(Url::create('/login')
                    ->setLastModificationDate(\Carbon\Carbon::now())
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority(0.8))
                ->add(Url::create('/login/facebook')
                    ->setLastModificationDate(\Carbon\Carbon::now())
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority(0.8))
                ->add(Url::create('/login/google')
                    ->setLastModificationDate(\Carbon\Carbon::now())
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority(0.8))
                ->add(Url::create('/register')
                    ->setLastModificationDate(\Carbon\Carbon::now())
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority(0.8))
                ->add(Url::create('/profile')
                    ->setLastModificationDate(\Carbon\Carbon::now())
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority(0.8))
                ->add(Url::create('/profile/posts')
                    ->setLastModificationDate(\Carbon\Carbon::now())
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority(0.8))
                ->add(Url::create('/profile/favourites')
                    ->setLastModificationDate(\Carbon\Carbon::now())
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority(0.8))
                ->add(Url::create('/profile/mailer')
                    ->setLastModificationDate(\Carbon\Carbon::now())
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority(0.8))
                ->add(Url::create('/profile/subscription')
                    ->setLastModificationDate(\Carbon\Carbon::now())
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority(0.8))
                ->add(Url::create('/post/create')
                    ->setLastModificationDate(\Carbon\Carbon::now())
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority(0.8))
                ->add(Url::create('/posts/create/service')
                    ->setLastModificationDate(\Carbon\Carbon::now())
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority(0.8))
                ->add(Url::create('/faq')
                    ->setLastModificationDate(\Carbon\Carbon::now())
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority(0.8))
                ->add(Url::create('/plans')
                    ->setLastModificationDate(\Carbon\Carbon::now())
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority(0.8))
                ->add(Url::create('/contact-us')
                    ->setLastModificationDate(\Carbon\Carbon::now())
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority(0.8))
                ->add(Url::create('/terms')
                    ->setLastModificationDate(\Carbon\Carbon::now())
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority(0.8))
                ->add(Url::create('/privacy')
                    ->setLastModificationDate(\Carbon\Carbon::now())
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority(0.8))
                ->add(Url::create('/sitemap')
                    ->setLastModificationDate(\Carbon\Carbon::now())
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority(0.8))
                ->writeToFile(public_path('sitemap.xml'));
            
            Log::channel('single')->info('[custom.info][sitemap.generate] Site map generated successfully');
        } catch (\Throwable $th) {
            Log::channel('single')->error('[custom.error][sitemap.generate] Site map generation fails. '.$th->getMessage());
        }
    }
}
