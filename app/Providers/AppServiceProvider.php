<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Builder::macro('whereLike', function ($attributes, string $searchStrings) {
            $this->where(function (Builder $query) use ($attributes, $searchStrings) {
                foreach (Arr::wrap($attributes) as $attribute) {
                    foreach(explode(' ', $searchStrings) as $searchString) {
                        $query->when(
                            str_contains($attribute, '.'),
                            function (Builder $query) use ($attribute, $searchString) {
                                [$relationName, $relationAttribute] = explode('.', $attribute);
            
                                $query->orWhereHas($relationName, function (Builder $query) use ($relationAttribute, $searchString) {
                                    $query->where($relationAttribute, 'LIKE', "%{$searchString}%");
                                });
                            },
                            function (Builder $query) use ($attribute, $searchString) {
                                $query->orWhere($attribute, 'LIKE', "%{$searchString}%");
                            }
                        );
                    }
                }
            });
        
            return $this;
        });

        /**
         * Paginate a standard Laravel Collection.
         *
         * @param int $perPage
         * @param int $total
         * @param int $page
         * @param string $pageName
         * @return array
         */
        Collection::macro('paginate', function($perPage, $total = null, $page = null, $pageName = 'page') {
            $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);

            return new LengthAwarePaginator(
                $this->forPage($page, $perPage),
                $total ?: $this->count(),
                $perPage,
                $page,
                [
                    'path' => LengthAwarePaginator::resolveCurrentPath(),
                    'pageName' => $pageName,
                ]
            );
        });
    }
}
