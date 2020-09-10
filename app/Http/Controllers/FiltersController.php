<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Http\Controllers\UsdExchangeController;

class FiltersController extends Controller
{
    public function filter(Request $request) {
        $posts = $this->getPostsByIds( json_decode($request->postsIds) );
        if ($posts->isEmpty()) {
            return false;
        }
        $filters = (array) json_decode($request->filters);
        $currency = $filters['currency'];
        unset($filters['currency']);
        // ensure that sorting comes in the end of filtering
        if (array_key_exists('sort',$filters)) {
            $sortMode = $filters['sort'];
            unset($filters['sort']);
            $filters = $filters + array( 'sort' => $sortMode);
        }
        if (array_key_exists('costFrom',$filters) && $currency!='USD') {
            $filters['costFrom'] = UsdExchangeController::uahToUsd($filters['costFrom']);
        } 
        if (array_key_exists('costTo',$filters)) {
            $filters['costTo'] = UsdExchangeController::uahToUsd($filters['costTo']);
        } 
        foreach($filters as $filter=>$value) {
            $posts = $this->$filter($posts, $value);
            if (!$posts || $posts->isEmpty()) {
                return false;
            }
        }
        $posts = $posts->paginate(env('POSTS_PER_PAGE'));
        return view('components.filtered-items', ['posts'=>$posts]);
    }

    private function getPostsByIds($postsIds) {
        foreach ($postsIds as &$post) {
            $post = Post::findOrFail($post);
        }
        return collect($postsIds);
    }

    private function costFrom($posts, $cost) {
        $filtered = $posts->filter(function($post, $key) use ($cost) {
            if ($post->currency!='USD') {
                return UsdExchangeController::uahToUsd($post->cost) >= $cost;
            }
            return $post->cost >= $cost;
        });
        return $filtered;
    }

    private function costTo($posts, $cost) {
        $filtered = $posts->filter(function($post, $key) use ($cost) {
            if ($post->currency!='USD') {
                return UsdExchangeController::uahToUsd($post->cost) <= $cost;
            }
            return $post->cost <= $cost;
        });
        return $filtered;
    }

    private function condition($posts, $condition) {
        $filtered = $posts->filter(function($post, $key) use ($condition) {
            return $post->condition == $condition;
        });
        return $filtered;
    }

    private function role($posts, $role) {
        $filtered = $posts->filter(function($post, $key) use ($role) {
            return $post->role == $role;
        });
        return $filtered;
    }

    private function type($posts, $type) {
        $filtered = $posts->filter(function($post, $key) use ($type) {
            return $post->type == $type;
        });
        return $filtered;
    }

    private function region($posts, $region) {
        $filtered = $posts->filter(function($post, $key) use ($region) {
            return $post->region_encoded == $region;
        });
        return $filtered;
    }

    private function sort($posts, $value) {
        switch ($value) {
            case '2':
                $sorted = $posts->sortBy('created_at');
                return $sorted;
            case '3':
                $sorted = $posts->sortBy(function ($post, $key) {
                    if ($post->cost && $post->currency!='USD') {
                        return UsdExchangeController::uahToUsd($post->cost);
                    }
                    return $post->cost;
                });
                return $sorted;
            case '4':
                $sorted = $posts->sortByDesc(function ($post, $key) {
                    if ($post->cost && $post->currency!='USD') {
                        return UsdExchangeController::uahToUsd($post->cost);
                    }
                    return $post->cost;
                });
                return $sorted;
            default:
                break;
        }
        return $posts;
    }
}
