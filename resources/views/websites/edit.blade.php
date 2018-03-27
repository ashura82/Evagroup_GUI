@extends('layout.full')

@section('title')
    Modification du vhost : {{ $key }}
@endsection

@section('breadcrumb')
    @parent
    <li><a href="{{ route('websites.index') }}">Websites</a></li>
    <li><a href="{{ route('websites.vhost', ['key' => $key]) }}">{{ $key }}</a></li>
    <li class="active">Editer</li>
@endsection

@section('content')
    <div id="vhost-edit-div" class="loader"></div>
@endsection

@section('scripts')
    <script>
        update_vhosts();
        setInterval(update_vhosts(),60000);
        function update_vhosts(){
            $.ajax({
                method: "GET",
                url: "{{ route('api.websites.vhost.form', ['key' => $key]) }}"
            })
            .done(function( data ) {
                $("#vhost-edit-div").removeClass('loader').html(data);
            })
            .fail(function(data) {
                console.log(data);
                $("#vhost-edit-div").removeClass('loader').html(data.responseJSON.message);
            });
        }
    </script>
@endsection