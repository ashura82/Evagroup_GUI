@extends('layout.full')

@section('title')
    Vhost {{ $key }}
@endsection

@section('breadcrumb')
    <li><a href="{{ route('websites.index') }}">Websites</a></li>
    <li class="active">{{ $key }}</li>
@endsection

@section('content')
    <div id="vhost-show-div" class="loader"></div>
@endsection

@section('scripts')
    <script>
        update_vhosts();
        setInterval(update_vhosts(),60000);
        function update_vhosts(){
            $.ajax({
                method: "GET",
                url: "{{ route('api.websites.vhost', ['key' => $key]) }}"
            })
            .done(function( data ) {
                $("#vhost-show-div").removeClass('loader').html(data);
            })
            .fail(function(data) {
                console.error(data);
                $("#vhost-show-div").removeClass('loader').html(data.responseJSON.message);
            });
        }
    </script>
@endsection