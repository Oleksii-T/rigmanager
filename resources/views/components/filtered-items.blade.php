<span class="filtered-amount" hidden>{{$posts->total()}}</span>

<div class="searched-content catalog">
    <x-items :posts="$posts" type='list'/>
</div>

<div class="searched-content pagination-field filter-pagination">
    {{ $posts->links() }}
</div>