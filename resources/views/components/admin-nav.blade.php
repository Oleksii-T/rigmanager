<aside class="side">
    <a href="#side-block" data-fancybox class="side-mob">Admin Panel</a>
    <div class="side-block" id="side-block">
        <div class="side-title">Admin Panel</div>
        <ul class="side-list">
            <li><a href="{{route('admin.panel')}}" class="{{$active=="overview" ? 'active' : ''}}">Overview</a></li>
            <li><a href="{{route('admin.user-access')}}" class="{{$active=="user-access" ? 'active' : ''}}">User Accesss</a></li>
            <li><a href="{{route('admin.mailers')}}" class="{{$active=="mailers" ? 'active' : ''}}">Mailers</a></li>
            <li><a href="{{route('admin.graphs')}}" class="{{$active=="graphs" ? 'active' : ''}}">Graphs</a></li>
            <li><a href="{{route('admin.unverified-posts')}}" class="{{$active=="up" ? 'active' : ''}}">Unverified Posts</a></li>
            <li><a href="https://adm.rigmanager.com.ua/phpmyadmin/index.php">phpMyAdmin</a></li>
            <li><a href="{{loc_url(route('home')) . '/admin/voyager'}}">Voyager</a></li>
        </ul>
    </div>
</aside>