<p class="filtered-items-no" hidden>{{$posts->total()}}</p>

<x-items :posts="$posts" button='addToFav' :translated="$translated"/>

<div class="pagination-field filter-pagination">
    {{ $posts->links() }}
</div>