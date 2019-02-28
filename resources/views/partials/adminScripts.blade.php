<script>
    var baseUrl = "{{ url('/') }}";
            var localeLang = "{{ config('app.locale') }}";
</script>
<script src="{{ asset('js/app.js') }}"></script>
@yield('scripts')
