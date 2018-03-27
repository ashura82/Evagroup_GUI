@extends('layout.full')

@section('title')
    Liste des Vhosts
@endsection

@section('breadcrumb')
    <li class="active">Websites</li>
@endsection

@section('content')
    <div class="text-right"><a href="{{ route('websites.vhost.add') }}" class="btn btn-success">Ajouter un Vhost</a></div>
    <div id="vhosts-div" class="loader"></div>
@endsection

@section('scripts')
    <script>
        update_vhosts();
        setInterval(update_vhosts(),60000);
        function update_vhosts(){
            $.ajax({
                method: "GET",
                url: "{{ route('api.websites.vhosts') }}"
            })
            .done(function( data ) {
                $("#vhosts-div").removeClass('loader').html(data);
            })
            .fail(function(data) {
                console.log(data);
                $("#vhosts-div").removeClass('loader').html(data.responseJSON.message);
            });
        }
    </script>
@endsection