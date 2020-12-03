<p class="filtered-items-no" hidden>{{$posts->total()}}</p>

<x-search-items :p="$posts" :t="$translated"/>

<div class="pagination-field filter-pagination">
    {{ $posts->links() }}
</div>