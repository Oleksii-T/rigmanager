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
            return $this->searchText($request->all());
        } else if (isset($request->author)){
            return $this->searchAuthor($request->all());
        } else if (isset($request->type)) {
            return $this->searchType($request->all());
        }
    }

    public function searchType($input) 
    {
        $type = $input['type'];
        switch ($type) {
            case 'equipment-buy':
                $posts_list = Post::where(["is_active"=>1, 'type'=>[2,3,4]])->get();
                $value['name'] = __('ui.introBuyEq');
                break;
            case 'services':
                $posts_list = Post::where(["is_active"=>1, 'type'=>[5,6]])->get();
                $value['name'] = __('ui.introSe');
                break;
            case 'tenders':
                $posts_list = Post::where(["is_active"=>1, 'type'=>7])->get();
                $value['name'] = __('ui.introTender');
                break;
            default: //for equipment sell and not incorrect searches
                $posts_list = Post::where(["is_active"=>1, 'type'=>1])->get();
                $value['name'] = __('ui.introSellEq');
                break;
        }
        $value['url'] = $type;
        if (isset($input['tag'])) {
            $tag = $this->getIdByUrl($input['tag']);
            $posts_list = $this->filterByTag($posts_list->pluck('id'), $tag);
            $resByTag = $this->countResultByTags($posts_list, $tag);
        } else {
            $resByTag = $this->countResultByTags($posts_list);
        }
        return $this->serializeSearch($posts_list, $resByTag, 'type', $value);
    }

    public function searchText($input)
    {
        $searchStrings = $input['text'];
        $posts_list = Post::search($searchStrings)->where("is_active", 1);
        if ( $posts_list->raw()['hits'] && count($posts_list->raw()['hits']) < $posts_list->raw()['nbHits'] ) {
            Log::channel('single')->error('[custom.error][search.filter] Algolia returns more records['.$posts_list->raw()['nbHits'].'] than can be fetched['.count($posts_list->raw()['hits']).']. Filtering system may ignored part of result. Search query: ["'.$searchStrings.'"]');
        }
        $posts_list = $posts_list->get();
        if (isset($input['tag'])) {
            $tag = $this->getIdByUrl($input['tag']);
            $posts_list = $this->filterByTag($posts_list->pluck('id'), $tag);
            $resByTag = $this->countResultByTags($posts_list, $tag);
        } else {
            $resByTag = $this->countResultByTags($posts_list);
        }
        return $this->serializeSearch($posts_list, $resByTag, 'text', $searchStrings);
    }

    private function filterByTag($matchings, $tag) 
    {
        $regex = str_replace('.', '\.', "^$tag(.[0-9]+)*$"); //make regex from tag and escape regex '.' via '\'
        $posts = Post::whereRaw("tag_encoded REGEXP '$regex'")->whereIn('id', $matchings);
        return $posts->get();
    }

    public function searchTag(Request $request)
    {
        $tagUrl = request()->segment(count(request()->segments()));
        $tagId = $this->getIdByUrl($tagUrl);
        $regex = str_replace('.', '\.', "^$tagId(.[0-9]+)*$"); //make regex from tag and escape regex '.' via '\'
        $posts_list = Post::whereRaw("tag_encoded REGEXP '$regex'")->where("is_active", 1); //search appropriate for posts using raw where query
        $resByTag = $this->countResultByTags($posts_list->get(), $tagId);
        return $this->serializeSearch($posts_list->get(), $resByTag, 'tags', ['tagMap'=>$this->getTagMap($tagId), 'tagTypeMap'=>$this->getTagType($tagId)]);
    }

    public function searchAuthor($input)
    {
        $author = $input['author'];
        $user = User::where('url_name', $author)->first();
        if (!$user) {
            abort(404);
        }
        $posts_list = $user->posts->where("is_active", 1);
        if (isset($input['tag'])) {
            $tag = $this->getIdByUrl($input['tag']);
            $posts_list = $this->filterByTag($posts_list->pluck('id'), $tag);
            $resByTag = $this->countResultByTags($posts_list, $tag);
        } else {
            $resByTag = $this->countResultByTags($posts_list);
        }
        return $this->serializeSearch($posts_list, $resByTag, 'author', ['name'=>$user->name, 'id'=>$user->id, 'url'=>$user->url_name]);
    }

    public function list() 
    {
        $posts_list = Post::where('is_active', 1)->get();
        $resByTag = $this->countResultByTags($posts_list);
        return $this->serializeSearch($posts_list, $resByTag, 'none');
    }

    private function serializeSearch($posts_list, $resByTag, $type, $value=null) 
    {
        $postsIds = json_encode($posts_list->pluck('id'));
        $posts_list = $posts_list->paginate(env('POSTS_PER_PAGE'));
        $postsAmount = $posts_list->total();
        $postsAmount == 0
            ? $search['isEmpty'] = true
            : $search['isEmpty'] = false;
        $search['type'] = $type;
        switch ($type) {
            case 'text':
                $search['value'] = $value;
                break;
            case 'type':
                $search['value'] = $value['name'];
                $search['url'] = $value['url'];
                break;
            case 'tags':
                $search['value'] = $value['tagMap'];
                $search['tag_type'] = $value['tagTypeMap'];
                break;
            case 'author':
                $search['value']['name'] = $value['name'];
                $search['value']['url'] = $value['url'];
                $search['value']['id'] = $value['id'];
                break;
            default:
                break;
        }
        $translated['title'] = 'title_'.App::getLocale();
        $translated['description'] = 'description_'.App::getLocale();
        return view('search.index', compact('posts_list', 'search', 'postsIds', 'postsAmount', 'translated', 'resByTag'));
    }

    private function countResultByTags($posts, $searchedTag=null) 
    {
        if ($posts->isEmpty()) {
            return null;
        }
        // if there is searched tag display info about sub tags 
        if ($searchedTag) {
            foreach ($posts as $post) {
                if ($post->tag_encoded == $searchedTag) {
                }
                if (isset($resByTag[$post->tag_encoded])) {
                    $resByTag[$post->tag_encoded]['amount']++;
                } else {
                    $resByTag[$post->tag_encoded]['amount'] = 1;
                    $resByTag[$post->tag_encoded]['url'] = $this->getUrlByTag($post->tag_encoded);
                    $resByTag[$post->tag_encoded]['name'] = 
                        $post->tag_encoded == $searchedTag
                        ? __('ui.noTag')
                        : $this->getTagNameById($post->tag_encoded);
                }
            }
            //remove one tag if it is the same is searched
            if ( count($resByTag) == 1 && $resByTag[array_key_first($resByTag)]['name'] == __('ui.noTag') )  {
                $resByTag=null;
            }
            $searchedTag = $this->getTagReadable($searchedTag);
        // if there is none tags searched, display only the highest layer of tags
        } else {
            foreach ($posts as $post) {
                $map = $this->getTagMap($post->tag_encoded);
                $firstPair = ['tagId'=>array_key_first($map), 'tagName'=>$map[array_key_first($map)]];
                if (isset($resByTag[$firstPair['tagId']])) {
                    $resByTag[$firstPair['tagId']]['amount']++;
                } else {
                    $resByTag[$firstPair['tagId']]['amount'] = 1;
                    $resByTag[$firstPair['tagId']]['url'] = $this->getUrlByTag($firstPair['tagId']);
                    $resByTag[$firstPair['tagId']]['name'] = $firstPair['tagName'];
                }
            }
        }
        $result = ['map'=>$resByTag, 'searchedTag'=>$searchedTag];
        return $result;
    }

}
