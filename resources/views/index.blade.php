@extends('layout.full')

@section('title')
    Tableau de bord
@endsection

@section('content')
    <div class="row">
        @foreach(['cpu', 'ram'] as $value)
            <div class="col-lg-2" id="{{ $value }}-wrapper">

            </div>
        @endforeach
    </div>
@endsection

@section('scripts')
    <script>
        displayCpu();
        setInterval(displayCpu, 4000);
        setInterval(displayRam, 30000);
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
    </script>
@endsection