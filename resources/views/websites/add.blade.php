@extends('layout.full')

@section('title')
    Ajouter un vhost
@endsection

@section('breadcrumb')
    @parent
    <li><a href="{{ route('websites.index') }}">Websites</a></li>
    <li class="active">Nouveau</li>
@endsection

@section('content')
    <div id="vhost-add-div">
        <form id="vhost-add-form">
            <div class="form-group">
                <label for="vhost-name">Nom du vhost</label>
                <input type="text" class="form-control" id="vhost-name" placeholder="mon.host">
            </div>
            <div class="form-group">
                <label for="vhost-key">Url du site</label>
                <input type="text" class="form-control" id="vhost-key" placeholder="www.mondomaine.com">
            </div>
            <div class="form-group">
                <label for="vhost-ip">Ip du serveur web</label>
                <input type="text" class="form-control" id="vhost-ip" placeholder="192.168.10.10">
            </div>
            <div class="form-group">
                <label for="vhost-port">Port de destination HTTP</label>
                <input type="text" class="form-control" id="vhost-port" placeholder="8080">
            </div>
            <div class="form-group">
                <label for="vhost-email">Email pour certificat HTTPS</label>
                <input type="email" class="form-control" id="vhost-email" placeholder="nom@mondomaine.com">
            </div>
            <p class="info-verifications main">&nbsp;</p>
            <div class="text-right">
                <button type="button" id="valid-form-btn" class="btn btn-success">Enregistrer</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        $('#valid-form-btn').click(function(){
            var key = $("#vhost-key").val();
            var ip = $("#vhost-ip").val();
            var port = $("#vhost-port").val();
            var mail = $("#vhost-email").val();
            var name = $("#vhost-name").val();
            $(".info-verifications").removeClass(['bg-success', 'bg-danger']).addClass('bg-info').text("Envoi du fichier");
            $.ajax({
                method: "POST",
                url: "{{ route('api.websites.add') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "key": key,
                    "ip": ip,
                    "port": port,
                    "mail": mail,
                    "name": name
                }
            })
            .done(function( data ) {
                $(".info-verifications").removeClass('bg-info').addClass('bg-success').text(data);
                window.location = "{{ route('websites.vhost') }}/" + name;
            })
            .fail(function(data) {
                $(".info-verifications").removeClass('bg-info').addClass('bg-danger').text(data.responseJSON.message);
            });
        });
    </script>
@endsection