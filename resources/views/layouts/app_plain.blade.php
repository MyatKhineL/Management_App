<!DOCTYPE html>
<html lang="en">

<!-- index-0.html  Tue, 07 Jan 2020 03:35:33 GMT -->

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Analytics &mdash; CodiePie')</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <link rel="stylesheet" href="{{ asset('css/pin_code.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/style.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/components.min.css') }}">






</head>

<body class="bg-light">
@yield('main')

<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/pin_code.js')}}"></script>

<script src="{{asset('js/app.js')}}"></script>

<script src="{{ asset('dashboard/js/CodiePie.js') }}"></script>
<script src="{{ asset('dashboard/js/scripts.js') }}"></script>
{{--<script src="{{ asset('dashboard/js/custom.js') }}"></script>--}}
{{--<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>--}}
<script src="{{ asset('dashboard/assets/bundles/lib.vendor.bundle.js')}}"></script>


@yield('scripts')


</body>



<script>

    // let token = document.head.querySelector('meta[name="csrf-token"]');
    // if (token) {
    //     $.ajaxSetup({
    //         headers: {
    //             "X-CSRF-TOKEN": token.content,
    //         },
    //     });
    // } else {
    //     console.log("csrf token not found");
    // }

</script>

</html>



