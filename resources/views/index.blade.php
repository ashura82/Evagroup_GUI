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
    </script>
@endsection