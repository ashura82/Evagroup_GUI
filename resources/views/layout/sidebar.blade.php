<ul class="nav nav-sidebar">
    <li {!! (Request::is('/') ? 'class="active"' : '') !!}>
        <a href="{!! route('index') !!}">Overview <span class="sr-only">(current)</span></a>
    </li>
    <li {!! (Request::is('websites') ? 'class="active"' : '') !!}>
        <a href="{!! route('websites.index') !!}">Websites</a>
    </li>
    <li {!! (Request::is('firewall') ? 'class="active"' : '') !!}>
        <a href="{!! route('firewall.index') !!}">Firewall</a>
    </li>
</ul>
<ul class="nav nav-sidebar">
    <li {!! (Request::is('') ? 'class="active"' : '') !!}><a href=""></a></li>
</ul>