<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Post;
use App\Http\Controllers\Traits\Tags;
use App\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\App;

class SearchController extends Controller
{
    use Tags;

    public function searchText(Request $request) 
    {
        if ($request->searchStrings) {
            $posts_list = Post::search($request->searchStrings)->where("is_active", 1);
            if ( $posts_list->raw()['hits'] && count($posts_list->raw()['hits']) < $posts_list->raw()['nbHits'] ) {
                Log::channel('single')->error('[custom.error][search.filter] Algolia returns more records['.$posts_list->raw()['nbHits'].'] than can be fetched['.count($posts_list->raw()['hits']).']. Filtering system may ignored part of result. Search query: ["'.$request->searchStrings.'"]');
            } 
            $postsIds = json_encode($posts_list->get()->pluck('id'));
            $posts_list = $posts_list->paginate(env('POSTS_PER_PAGE'));
            $postsAmount = $posts_list->total();
            $postsAmount == 0 
                ? $search['isEmpty'] = true 
                : $search['isEmpty'] = false;
            $search['type'] = 'text';
            $search['value'] = $request->searchStrings;
            $translated['title'] = 'title_'.App::getLocale();
            $translated['description'] = 'description_'.App::getLocale();
            return view('search.index', compact('posts_list', 'search', 'postsIds', 'postsAmount', 'translated'));
        } else {
            return redirect(loc_url(route('home')));
        }
    }
    
    public function searchTag($locale, $tagId=null) 
    {
        $tagId = $tagId==null ? $locale : $tagId;
        $regex = "^$tagId(.[0-9]+)*$"; //make regular expr form tag id to find sub catogories as well
        $regex = str_replace('.', '\.', $regex); //escape regex '.' via '\'
        $posts_list = Post::whereRaw("tag_encoded REGEXP '$regex'")->where("is_active", 1); //search appropriate for posts using raw where query
        $postsIds = json_encode($posts_list->get()->pluck('id'));
        $posts_list = $posts_list->paginate(env('POSTS_PER_PAGE'));
        //add success/fail flash depends on result
        $postsAmount = $posts_list->total();
        $postsAmount == 0 
            ? $search['isEmpty'] = true 
            : $search['isEmpty'] = false;
        $search['type'] = 'tags';
        $search['value'] = $this->getTagMap($tagId);
        $search['tag_type'] = $this->getTagType($tagId);
        $translated['title'] = 'title_'.App::getLocale();
        $translated['description'] = 'description_'.App::getLocale();
        return view('search.index', compact('posts_list', 'search', 'postsIds', 'postsAmount', 'translated'));
    }
    
    public function searchAuthor($locale, $authorId=null) 
    {
        $authorId = $authorId==null ? $locale : $authorId;
        $user = User::findOrFail($authorId);
        $posts_list = $user->posts->where("is_active", 1);
        $postsIds = json_encode($posts_list->pluck('id'));
        $posts_list = $posts_list->paginate(env('POSTS_PER_PAGE'));
        $postsAmount = $posts_list->total();
        $postsAmount == 0 
            ? $search['isEmpty'] = true 
            : $search['isEmpty'] = false;
        $search['type'] = 'author';
        $search['value']['name'] = $user->name;
        $search['value']['id'] = $authorId;
        $translated['title'] = 'title_'.App::getLocale();
        $translated['description'] = 'description_'.App::getLocale();
        return view('search.index', compact('posts_list', 'search', 'postsIds', 'postsAmount', 'translated'));
    }
    
}
