<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('js/sb-admin.min.js') }}"></script>
<script>
    var baseUrl = "{{ url('/') }}";
    var localeLang = "{{ config('app.locale') }}";
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

</script>
<script src="{{ asset('js/app.js') }}" defer></script>
@yield('scripts')
