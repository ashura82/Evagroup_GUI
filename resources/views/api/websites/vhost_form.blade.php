@extends('layout.ajax')
@section('content')
    <form id="{{ $key }}-form">
        <div class="form-group">
            <label>Clé du Vhost</label>
            <input value="{{ $key }}" type="text" class="form-control disabled" disabled="disabled">
        </div>
        <div class="form-group">
            <label for="vhost-conf">Configuration du vhost</label>
            <textarea class="form-control" id="vhost-conf" rows="15" style="width:100%;">{{ (string)$conf }}</textarea>
        </div>
        <p class="info-verifications main">&nbsp;</p>
        <div class="text-right">
            <button type="button" id="valid-form-btn" class="btn btn-success">Enregistrer</button>
        </div>
    </form>
@endsection

@section('scripts')
    <script>
        $('#valid-form-btn').click(function(){
            $(".info-verifications").removeClass(['bg-success', 'bg-danger']).addClass('bg-info').text("Envoi du fichier");
            $.ajax({
                method: "POST",
                url: "{{ route('api.websites.vhost.form', ['key' => $key]) }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "conf": $("#vhost-conf").val()
                }
            })
            .done(function( data ) {
                $(".info-verifications").removeClass('bg-info').addClass('bg-success').text(data);
            })
            .fail(function(data) {
                $(".info-verifications").removeClass('bg-info').addClass('bg-danger').text(data.responseJSON.message);
            });
        });
    </script>
@endsection
