<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Post;
use App\Tags;
use App\User;

class SearchController extends Controller
{
    use Tags;

    public function searchText(Request $request) 
    {
        $this->flush();
        if ($request->searchStrings) {
            $posts_list = Post::whereLike(['title', 'description'], $request->searchStrings)->paginate(env('POSTS_PER_PAGE'));
            $posts_list->total() == 0 
                ? Session::flash('searchStatus', __('ui.searchFail'))
                : Session::flash('searchStatus', __('ui.searchSuccess'));
            Session::flash('searchText', $request->searchStrings);    
            return view('search.index', compact('posts_list'));
        } else {
            return redirect(route('home.home'));
        }
    }
    
    public function searchTag($tagId) 
    {
        $this->flush();
        $regex = "^$tagId(.[0-9]+)*$"; //make regular expr form tag id to find sub catogories as well
        $regex = str_replace('.', '\.', $regex); //escape regex '.' via '\'
        $posts_list = Post::whereRaw("tag REGEXP '$regex'")->paginate(env('POSTS_PER_PAGE')); //search appropriate for posts using raw where query
        //add success/fail flash depends on result
        $posts_list->total() == 0 
            ? Session::flash('searchStatus', __('ui.searchFail')) 
            : Session::flash('searchStatus', __('ui.searchSuccess'));
        Session::flash('searchTags', $this->getTagNameByIdWithPath($tagId));
        return view('search.index', compact('posts_list'));
    }
    
    public function searchAuthor($authorId) 
    {
        $this->flush();
        $user = User::findOrFail($authorId);
        $posts_list = $user->posts->paginate(env('POSTS_PER_PAGE'));
        $posts_list->total() == 0 
            ? Session::flash('searchStatus', __('ui.searchFail')) 
            : Session::flash('searchStatus', __('ui.searchSuccess'));
        Session::flash('searchAuthorName', $user->name);
        Session::flash('searchAuthorId', $authorId);
        return view('search.index', compact('posts_list'));
    }

    private function flush () {
        // forget past flash massages
        Session::forget('searchText');
        Session::forget('searchTags');
        Session::forget('searchAuthorName');
        Session::forget('searchAuthorId');
    }
    
}
