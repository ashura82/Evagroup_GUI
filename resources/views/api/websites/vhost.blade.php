<div class="panel {{ $active ? 'panel-success' : 'panel-danger'}}">
    <div class="panel-heading">{{ $active ? 'En ligne' : 'Désactivé' }}</div>
    <div class="panel-body">
        {!! preg_replace('/(?:\r\n|\r|\n)/', '<br />', str_replace(' ', '&nbsp;', $conf)); !!}
    </div>
</div>
<div class="text-right">
    <a href="{{ route('websites.vhost.edit', ['key' => $key]) }}" class="btn btn-success">&Eacute;diter</a>
</div>
