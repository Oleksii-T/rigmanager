<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Post;
use App\Http\Controllers\Traits\Tags;
use App\User;

class SearchController extends Controller
{
    use Tags;

    public function searchText(Request $request) 
    {
        if ($request->searchStrings) {
            $posts_list = Post::search($request->searchStrings);
            $postsIds = json_encode($posts_list->get()->pluck('id'));
            $posts_list = $posts_list->paginate(env('POSTS_PER_PAGE'));
            $postsAmount = $posts_list->total();
            $postsAmount == 0 
                ? $search['isEmpty'] = true 
                : $search['isEmpty'] = false;
            $search['type'] = 'text';
            $search['value'] = $request->searchStrings;
            return view('search.index', compact('posts_list', 'search', 'postsIds', 'postsAmount'));
        } else {
            return redirect(route('home'));
        }
    }
    
    public function searchTag($tagId) 
    {
        $regex = "^$tagId(.[0-9]+)*$"; //make regular expr form tag id to find sub catogories as well
        $regex = str_replace('.', '\.', $regex); //escape regex '.' via '\'
        $posts_list = Post::whereRaw("tag_encoded REGEXP '$regex'"); //search appropriate for posts using raw where query
        $postsIds = json_encode($posts_list->get()->pluck('id'));
        $posts_list = $posts_list->paginate(env('POSTS_PER_PAGE'));
        //add success/fail flash depends on result
        $postsAmount = $posts_list->total();
        $postsAmount == 0 
            ? $search['isEmpty'] = true 
            : $search['isEmpty'] = false;
        $search['type'] = 'tags';
        $search['value'] = $this->getTagMap($tagId);
        return view('search.index', compact('posts_list', 'search', 'postsIds', 'postsAmount'));
    }
    
    public function searchAuthor($authorId) 
    {
        $user = User::findOrFail($authorId);
        $posts_list = $user->posts;
        $postsIds = json_encode($posts_list->pluck('id'));
        $posts_list = $posts_list->paginate(env('POSTS_PER_PAGE'));
        $postsAmount = $posts_list->total();
        $postsAmount == 0 
            ? $search['isEmpty'] = true 
            : $search['isEmpty'] = false;
        $search['type'] = 'author';
        $search['value']['name'] = $user->name;
        $search['value']['id'] = $authorId;
        return view('search.index', compact('posts_list', 'search', 'postsIds', 'postsAmount'));
    }
    
}
