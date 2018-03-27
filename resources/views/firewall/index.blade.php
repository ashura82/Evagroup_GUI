@extends('layout.full')

@section('title')
    Firewall
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Firewall</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel {{ $active ? 'panel-success' : 'panel-danger' }}">
                <div class="panel-heading clearfix">
                    <div class="pull-right">
                        @if($active)
                            <a href="{{ route('firewall.shutdown-csf') }}" class="btn btn-warning">Désactiver</a>
                        @else
                            <a href="{{ route('firewall.start-csf') }}" class="btn btn-success">Activer</a>
                        @endif
                    </div>
                    <h4>Le pare-feu est {{ $active ? 'actif' : 'inactif' }}</h4>
                </div>
                <div class="panel-body">
                    <div class="text-right">
                        <a href="{{ route('firewall.shutdown-csf') }}" class="btn btn-primary">Redémarrer le cluster</a>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <h3>Liste des tables</h3>
                            <i>Permet d'afficher le contenu de toutes les tables du pare-feu.</i>
                            <div class="form-group">
                                <button type="button" class="btn btn-default affiche-liste-btn">Afficher</button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h3>Ping IP</h3>
                            <i>Permet de tester l'état des membres du cluster.</i>
                            <div class="form-group">
                                <button type="button" class="btn btn-default ping-ip-btn">Ping</button>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <h3>Rechercher une IP</h3>
                            <i>Permet de rechercher une IP dans les tables du pare-feu.</i>
                            <div class="form-group">
                                <label for="search-ip-input">Addresse IP / Sous réseau CIDR</label>
                                <input type="text" class="form-control" id="search-ip-input" placeholder="185.102.34.66 ou 192.168.10.0/24">
                            </div>
                            <div class="form-group text-right">
                                <a href="#" class="btn btn-default affiche-recherche-btn">Rechercher</a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    @foreach($actions as $action)
                        <form action="{{ route($action['form_action']) }}" method="POST">
                            <input type="hidden" value="{{ csrf_token() }}" name="_token">
                            <h3>{{ $action['titre'] }}</h3>
                            <i>{{ $action['description'] }}</i>
                            <div class="form-group">
                                <label for="{{ $action['code'] }}-input">Addresse IP / Sous réseau CIDR</label>
                                <input type="text" class="form-control" id="{{ $action['code'] }}-input" name="ip" placeholder="185.102.34.66 ou 192.168.10.0/24">
                            </div>
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-{{ $action['button_color'] }}">{{ $action['button_text'] }}</button>
                            </div>
                        </form>
                    @endforeach
                </div>
            </div>
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
        $(".affiche-liste-btn").click(function(){
            $("#modal-evagroup .modal-content .modal-body").html('<div class="loader"></div>');
            $("#modal-evagroup .modal-content .modal-title").text("Liste des tables");
            $("#modal-evagroup").modal();
            $.ajax({
                method: "GET",
                url: "{{ route('api.firewall.liste') }}"
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

        $(".ping-ip-btn").click(function(){
            $("#modal-evagroup .modal-content .modal-body").html('<div class="loader"></div>');
            $("#modal-evagroup .modal-content .modal-title").text("Ping Ip");
            $("#modal-evagroup").modal();
            $.ajax({
                method: "GET",
                url: "{{ route('api.firewall.ping-ip') }}"
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

        $(".affiche-recherche-btn").click(function(){
            var ip = $("#search-ip-input").val();
            $("#modal-evagroup .modal-content .modal-body").html('<div class="loader"></div>');
            $("#modal-evagroup .modal-content .modal-title").text("Recherche de l'IP " + ip);
            $("#modal-evagroup").modal();
            $.ajax({
                method: "POST",
                url: "{{ route('api.firewall.recherche-ip') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    ip: ip
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