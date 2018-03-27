@extends('layout.full')

@section('title')
    Ajouter un vhost
@endsection

@section('breadcrumb')
    <li><a href="{{ route('websites.index') }}">Websites</a></li>
    <li class="active">Nouveau</li>
@endsection

@section('content')
    <div id="vhost-add-div">
        <form id="vhost-add-form">
            <div class="form-group">
                <label for="vhost-key">Clé du Vhost (pas d'espaces ni de majuscules)</label>
                <input type="text" class="form-control" id="vhost-key" placeholder="mon.vhost.name">
            </div>
            <div class="form-group">
                <label for="vhost-conf">Configuration du vhost</label>
                <textarea class="form-control" id="vhost-conf" rows="15" style="width:100%;"></textarea>
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
            $(".info-verifications").removeClass(['bg-success', 'bg-danger']).addClass('bg-info').text("Envoi du fichier");
            $.ajax({
                method: "POST",
                url: "{{ route('api.websites.add') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "key": key,
                    "conf": $("#vhost-conf").val()
                }
            })
            .done(function( data ) {
                $(".info-verifications").removeClass('bg-info').addClass('bg-success').text(data);
                window.location = "{{ route('websites.vhost') }}/" + key;
            })
            .fail(function(data) {
                $(".info-verifications").removeClass('bg-info').addClass('bg-danger').text(data.responseJSON.message);
            });
        });
    </script>
@endsection