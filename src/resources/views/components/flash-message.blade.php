@if (session('message'))
    @section('css')
        <link rel="stylesheet" href="{{ asset('vendor/toastr/toastr.min.css') }}">
    @endsection

    @section('js')
        <script src="{{ asset('vendor/toastr/toastr.min.js') }}"></script>
        <script>
            toastr.success('{{ session('message') }}')
        </script>
    @endsection
@endif
