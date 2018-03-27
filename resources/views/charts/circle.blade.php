@extends ('layout.ajax')

@section('content')
    <div id="chart-{{ $id }}"></div>
@endsection

@section('scripts')
    <script>
        $( document ).ready(function() {
            $("#chart-{{ $id }}").circliful({
                animation: 0,
                foregroundBorderWidth: 5,
                backgroundBorderWidth: 15,
                percent: "{{ $value }}",
                text: "{{ $text }}",
                textBelow: true,
                noPercentageSign: true,
                replacePercentageByText: "{{ $valueText }} {{ $unit }}"
            });
        });
    </script>
@endsection