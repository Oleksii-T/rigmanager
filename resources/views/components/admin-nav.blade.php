<aside class="side">
    <a href="#side-block" data-fancybox class="side-mob">Admin Panel</a>
    <div class="side-block" id="side-block">
        <div class="side-title">Admin Panel</div>
        <ul class="side-list">
            <li><a href="{{route('admin.panel')}}" class="{{$active=="overview" ? 'active' : ''}}">Overview</a></li>
            <li><a href="{{route('admin.user-access')}}" class="{{$active=="user-access" ? 'active' : ''}}">Users</a></li>
            <li><a href="{{route('admin.mailers')}}" class="{{$active=="mailers" ? 'active' : ''}}">Mailers</a></li>
            <li><a href="{{route('admin.graphs')}}" class="{{$active=="graphs" ? 'active' : ''}}">Graphs</a></li>
            <li><a href="{{route('admin.up')}}" class="{{$active=="up" ? 'active' : ''}}">Post verification</a></li>
            <li><a href="{{route('admin.uph')}}" class="{{$active=="uph" ? 'active' : ''}}">Verified Posts Hystory</a></li>
            <li><a href="{{route('admin.blog.create')}}" class="{{$active=="blog" ? 'active' : ''}}">Create blog</a></li>
            <li><a href="https://adm.rigmanager.com.ua/phpmyadmin/index.php">phpMyAdmin</a></li>
            <li><a href="{{loc_url(route('home')) . '/admin/voyager'}}">Voyager</a></li>
        </ul>
    </div>
</aside>