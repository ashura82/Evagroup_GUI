@extends('layout.full')

@section('title')
    Tableau de bord
@endsection

@section('breadcrumb')
    <li class="active"><i class="fa fa-home" aria-hidden="true"></i></li>
@endsection

@section('content')
    <div class="row">
        @foreach(['cpu', 'ram', 'disk'] as $value)
            <div class="col-md-2" id="{{ $value }}-wrapper">
                <div class="loader"></div>
            </div>
        @endforeach
        <div class="col-md-6">
            <h3>Ressources materielles</h3>
            <ul>
                <li>Mémoire utilisée : <span id="ram-used-wrapper"><i class="fa fa-circle-o-notch spin-animate" aria-hidden="true"></i></span> / <span id="ram-total-wrapper"><i class="fa fa-circle-o-notch spin-animate" aria-hidden="true"></i></span></li>
                <li>Espace disque : <span id="disk-used-wrapper"><i class="fa fa-circle-o-notch spin-animate" aria-hidden="true"></i></span> / <span id="disk-total-wrapper"><i class="fa fa-circle-o-notch spin-animate" aria-hidden="true"></i></span></li>
            </ul>
            <h3>Mise en réseau</h3>
            <ul>
                <li>Bande passante sortante : <span id="network-tx-wrapper"><i class="fa fa-circle-o-notch spin-animate" aria-hidden="true"></i></span></li>
                <li>Bande passante entrante : <span id="network-rx-wrapper"><i class="fa fa-circle-o-notch spin-animate" aria-hidden="true"></i></span></li>
            </ul>
        </div>
    </div>
    <hr>
    <h2>Fichiers de logs</h2>
    <div class="row">
        <div class="col-md-5">
            <ul class="list-group">
                <li class="list-group-item"><a href="#" data-tile="Daemon.log" data-file="daemon.log" class="btn-log btn-block">Deamon.log</a></li>
                <li class="list-group-item"><a href="#" data-tile="Lfd.log" data-file="lfd.log" class="btn-log btn-block">Lfd.log</a></li>
                <li class="list-group-item"><a href="#" data-tile="Auth.log" data-file="auth.log" class="btn-log btn-block">Auth.log</a></li>
                <li class="list-group-item"><a href="#" data-tile="Csf.allow" data-file="csf.allow" class="btn-log btn-block">Csf.allow</a></li>
                <li class="list-group-item"><a href="#" data-tile="Csf.deny" data-file="csf.deny" class="btn-log btn-block">Csf.deny</a></li>
            </ul>
        </div>
    </div>
    <div class="modal fade bs-example-modal-lg" id="modal-evagroup" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        displayCpu();
        displayRam();
        displayDisk();
        displayNetworkRx();
        displayNetworkTx();
        getMemAndDisk();
        setInterval(displayCpu, 4000);
        setInterval(displayNetworkRx, 4000);
        setInterval(displayNetworkTx, 4000);
        setInterval(displayRam, 30000);
        setInterval(displayDisk, 30000);
        setInterval(getMemAndDisk, 30000);
        function displayCpu(){
            $.ajax({
                method: "GET",
                url: "{{ route('api.metrics.cpu') }}"
            })
                .done(function( data ) {
                    $("#cpu-wrapper").html(data);
                })
                .fail(function( data ) {
                    console.error(data);
                });
        }

        function displayRam(){
            $.ajax({
                method: "GET",
                url: "{{ route('api.metrics.ram') }}"
            })
                .done(function( data ) {
                    $("#ram-wrapper").html(data);
                })
                .fail(function( data ) {
                    console.error(data);
                });
        }

        function displayDisk(){
            $.ajax({
                method: "GET",
                url: "{{ route('api.metrics.disk') }}"
            })
                .done(function( data ) {
                    $("#disk-wrapper").html(data);
                })
                .fail(function( data ) {
                    console.error(data);
                });
        }

        function displayNetworkRx(){
            $.ajax({
                method: "GET",
                url: "{{ route('api.metrics.network-rx') }}"
            })
                .done(function( data ) {
                    $("#network-rx-wrapper").html(data);
                })
                .fail(function( data ) {
                    console.error(data);
                });
        }

        function displayNetworkTx(){
            $.ajax({
                method: "GET",
                url: "{{ route('api.metrics.network-tx') }}"
            })
                .done(function( data ) {
                    $("#network-tx-wrapper").html(data);
                })
                .fail(function( data ) {
                    console.error(data);
                });
        }

        function getMemAndDisk(){
            $.ajax({
                method: "GET",
                url: "{{ route('api.metrics.mem-and-disk') }}"
            })
                .done(function( data ) {
                    var tmp = JSON.parse(data);
                    $("#ram-used-wrapper").html(tmp.ram_u + " MiB");
                    $("#ram-total-wrapper").html(tmp.ram_t + " MiB");
                    $("#disk-used-wrapper").html(tmp.disk_u + " GiB");
                    $("#disk-total-wrapper").html(tmp.disk_t + " GiB");
                })
                .fail(function( data ) {
                    console.error(data);
                });
        }

        $(".btn-log").click(function(){
            var title = $(this).data('title');
            var file = $(this).data('file');
            $("#modal-evagroup .modal-content .modal-body").html('<div class="loader"></div>');
            $("#modal-evagroup .modal-content .modal-title").text(title);
            $("#modal-evagroup").modal();
            $.ajax({
                method: "POST",
                url: "{{ route('index.log') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    file: file
                }
            })
            .done(function( data ) {
                $("#modal-evagroup .modal-content .modal-body").html("");
                $("#modal-evagroup .modal-content .modal-body").html("<pre>" + data + "</pre>");
            })
            .fail(function( data ) {
                console.error(data);
                $("#modal-evagroup").modal('hide');
            });
        });
    </script>
@endsection