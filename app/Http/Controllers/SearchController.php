<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Traits\Tags;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Post;
use App\User;

class SearchController extends Controller
{
    use Tags;

    public function search(Request $request) 
    {
        if (isset($request->text)) {
            return $this->searchText($request->text);
        } else if (isset($request->author)){
            return $this->searchAuthor($request->author);
        } else if (isset($request->type)) {
            return $this->searchType($request->type);
        }
    }

    public function searchType($type) 
    {
        switch ($type) {
            case 'equipment-sell':
                $posts_list = Post::where(["is_active"=>1, 'type'=>1]);
                $search['value'] = __('ui.introSellEq');
                break;
            case 'equipment-buy':
                $posts_list = Post::where(["is_active"=>1, 'type'=>[2,3,4]]);
                $search['value'] = __('ui.introBuyEq');
                break;
            case 'services':
                $posts_list = Post::where(["is_active"=>1, 'type'=>[5,6]]);
                $search['value'] = __('ui.introSe');
                break;
            case 'tenders':
                $posts_list = Post::where(["is_active"=>1, 'type'=>7]);
                $search['value'] = __('ui.introTender');
                break;
            default:
                $posts_list = Post::where(["title"=>'no title empty']);
                break;
        }
        $postsIds = json_encode($posts_list->pluck('id'));
        $posts_list = $posts_list->paginate(env('POSTS_PER_PAGE'));       
        $postsAmount = $posts_list->total();
        $postsAmount == 0
            ? $search['isEmpty'] = true
            : $search['isEmpty'] = false;
        $search['type'] = 'type';
        $translated['title'] = 'title_'.App::getLocale();
        $translated['description'] = 'description_'.App::getLocale();
        return view('search.index', compact('posts_list', 'search', 'postsIds', 'postsAmount', 'translated'));
    }

    public function searchText($searchStrings)
    {
        $posts_list = Post::search($searchStrings)->where("is_active", 1);
        if ( $posts_list->raw()['hits'] && count($posts_list->raw()['hits']) < $posts_list->raw()['nbHits'] ) {
            Log::channel('single')->error('[custom.error][search.filter] Algolia returns more records['.$posts_list->raw()['nbHits'].'] than can be fetched['.count($posts_list->raw()['hits']).']. Filtering system may ignored part of result. Search query: ["'.$searchStrings.'"]');
        }
        $postsIds = json_encode($posts_list->get()->pluck('id'));
        $posts_list = $posts_list->paginate(env('POSTS_PER_PAGE'));
        $postsAmount = $posts_list->total();
        $postsAmount == 0
            ? $search['isEmpty'] = true
            : $search['isEmpty'] = false;
        $search['type'] = 'text';
        $search['value'] = $searchStrings;
        $translated['title'] = 'title_'.App::getLocale();
        $translated['description'] = 'description_'.App::getLocale();
        return view('search.index', compact('posts_list', 'search', 'postsIds', 'postsAmount', 'translated'));
    }

    public function searchTag($locale, $tagUrl=null)
    {
        dd('search tag');
        $tagUrl = $tagUrl==null ? $locale : $tagUrl;
        $tagId = $this->getIdByUrl($tagUrl);
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
        $search['url_map'] = $this->getTagUrlMap($tagId);
        $search['tag_type'] = $this->getTagType($tagId);
        $translated['title'] = 'title_'.App::getLocale();
        $translated['description'] = 'description_'.App::getLocale();
        return view('search.index', compact('posts_list', 'search', 'postsIds', 'postsAmount', 'translated'));
    }

    public function searchAuthor($author)
    {
        $user = User::where('name', $author)->first();
        $posts_list = $user->posts->where("is_active", 1);
        $postsIds = json_encode($posts_list->pluck('id'));
        $posts_list = $posts_list->paginate(env('POSTS_PER_PAGE'));
        $postsAmount = $posts_list->total();
        $postsAmount == 0
            ? $search['isEmpty'] = true
            : $search['isEmpty'] = false;
        $search['type'] = 'author';
        $search['value']['name'] = $user->name;
        $search['value']['id'] = $user->id;
        $translated['title'] = 'title_'.App::getLocale();
        $translated['description'] = 'description_'.App::getLocale();
        return view('search.index', compact('posts_list', 'search', 'postsIds', 'postsAmount', 'translated'));
    }

    public function list() 
    {
        $posts_list = Post::where('is_active', 1);
        $postsIds = json_encode($posts_list->pluck('id'));
        $posts_list = $posts_list->paginate(env('POSTS_PER_PAGE'));
        $postsAmount = $posts_list->total();
        $postsAmount == 0
            ? $search['isEmpty'] = true
            : $search['isEmpty'] = false;
        $search['type'] = 'none';
        $translated['title'] = 'title_'.App::getLocale();
        $translated['description'] = 'description_'.App::getLocale();
        return view('search.index', compact('posts_list', 'search', 'postsIds', 'postsAmount', 'translated'));
    }

}
