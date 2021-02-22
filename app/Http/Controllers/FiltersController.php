<?php

namespace App\Http\Controllers;

use App\Http\Controllers\UsdExchangeController;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Post;

class FiltersController extends Controller
{
    public function filter(Request $request) 
    {
        $posts = $this->getPostsByIds( json_decode($request->postsIds) ); //get array of posts by array of ids
        if ($posts->isEmpty()) {
            return false;
        }
        $filters = (array) json_decode($request->filters); //convert json to array of filters
        $currency = $filters['currency']; //remember currency to local variable
        unset($filters['currency']); //remove currency from filters
        // ensure that sorting comes in the end of filtering
        if (array_key_exists('sort',$filters)) {
            $sortMode = $filters['sort'];
            unset($filters['sort']);
            $filters = $filters + array( 'sort' => $sortMode);
        }
        // convert cost-from to USD
        if (array_key_exists('costFrom',$filters) && $currency!='USD') {
            $filters['costFrom'] = UsdExchangeController::uahToUsd($filters['costFrom']);
        }
        // convert cost-to to USD
        if (array_key_exists('costTo',$filters) && $currency!='USD') {
            $filters['costTo'] = UsdExchangeController::uahToUsd($filters['costTo']);
        }
        // filter the array of posts
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
        if (!$cost) {
            return $posts;
        }
        $filtered = $posts->filter(function($post, $key) use ($cost) {
            if ($post->currency!='USD') {
                return UsdExchangeController::uahToUsd($post->cost) >= $cost;
            }
            return $post->cost >= $cost; // if posts cost empty returns false
        });
        return $filtered;
    }

    private function costTo($posts, $cost) {
        if (!$cost) {
            return $posts;
        }
        $filtered = $posts->filter(function($post, $key) use ($cost) {
            if ($post->currency!='USD') {
                return UsdExchangeController::uahToUsd($post->cost) <= $cost;
            }
            return $post->cost <= $cost;
        });
        return $filtered;
    }

    private function condition($posts, $condition) {
        if (!$condition) {
            return false;
        }
        $filtered = $posts->filter(function($post, $key) use ($condition) {
            return in_array($post->condition, $condition);
        });
        return $filtered;
    }

    private function role($posts, $role) {
        if (!$role) {
            return false;
        }
        $filtered = $posts->filter(function($post, $key) use ($role) {
            return in_array($post->role, $role);
        });
        return $filtered;
    }

    private function type($posts, $type) {
        if (!$type) {
            return false;
        }
        $filtered = $posts->filter(function($post, $key) use ($type) {
            return in_array($post->type, $type);
        });
        return $filtered;
    }

    private function region($posts, $region) {
        if ($region == 0) {
            return $posts;
        }
        $filtered = $posts->filter(function($post, $key) use ($region) {
            return $post->region_encoded == $region;
        });
        return $filtered;
    }

    private function thread($posts, $thread) {
        if (!$thread) {
            return false;
        }
        $filtered = $posts->filter(function($post, $key) use ($thread) {
            return in_array($post->thread, $thread);
        });
        return $filtered;
    }

    private function sorting($posts, $value) {
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
