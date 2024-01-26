<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



    <link rel="shortcut icon" type="image/x-icon" href="../assets/images/favicon/favicon.ico">


    <link href="{{ asset('assets/fonts/feather/feather.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/libs/bootstrap-icons/font/bootstrap-icons.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('assets/css/theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/emoji.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/all.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/toast.min.css') }}">

    <title> @yield('page_title') </title>

    <style>
        .al_bg {
            background: linear-gradient(to right, #b04300, #ff0000) !important;
        }
    </style>

</head>



<body>
    <div id="db-wrapper">
        @include('layout.inc.nav')
        <div id="page-content">
            @include('layout.inc.header')
            <div class="container-fluid p-4">

                @if ($errors->any())
                    <div id="refresh" class="alert al_bg"
                        style="position:fixed; top:10px; right:10px; z-index:10000; width: auto;">
                        <i class="text-white">
                            @foreach ($errors->all() as $error)
                                {{ $error }} <br />
                            @endforeach
                        </i>
                    </div>
                @endif

                @yield('page_content')

            </div>

        </div>
    </div>



    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/js/theme.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/toast.js') }}"></script>



    <script>
        $(function() {


            $("#search").on('keyup', function(e) {
                e.preventDefault()
                param = $('#search');

                str = param.val().trim()

                if (!str) {
                    return;
                }

                $.ajax({
                    method: 'get',
                    url: '/search',
                    data: {
                        's': str
                    },
                    beforeSend: () => {
                        body = $('.sbox');
                        body.show();
                        body.html(`
                            <a class=" mt-3 py-2 bt" href="javscript:;" >
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                Fetch Items ...
                            </a>
                        `)
                    }
                }).done((res) => {
                    console.log(res);
                    body.html(``);

                    if (res.length == 0) {
                        body.html(`
                            <div class="bg-danger mt-2  text-white p-2 rounded" >
                                No item found
                            </div>
                        `)
                    }

                    res.map((item, index) => {
                        body.append(`
                            <a href="javascript:;" class="text-dark search_item" data-data='${JSON.stringify(item)}' >
                                <div class="d-flex justify-content-between  py-1">
                                    <div class="w-10">
                                        <span> # ${item.id}</span>
                                    </div>
                                    <div class="w-50">
                                        <span class="fw-bold"> ${item.name} </span>
                                    </div>
                                    <div class="w-20">
                                        <span>${item.price}</span>
                                    </div>
                                    <div class="">
                                        <span>6</span>
                                    </div>
                                </div>
                            </a>
                        `)
                    })
                }).fail((res) => {
                    console.log(res);
                })
            })
        })
    </script>

    @if (session('error'))
        <script>
            Toastify({
                text: "<?= session('error') ?>",
                duration: 5000,
                close: true,
                gravity: "top", // `top` or `bottom`
                position: "right", // `left`, `center` or `right`
                stopOnFocus: true, // Prevents dismissing of toast on hover
                style: {
                    background: "linear-gradient(to right, #b04300, #ff0000)",
                },
            }).showToast();
        </script>
    @endif

    @if (session('success'))
        <script>
            Toastify({
                text: "<?= session('success') ?>",
                duration: 5000,
                close: true,
                gravity: "top", // `top` or `bottom`
                position: "right", // `left`, `center` or `right`
                stopOnFocus: true, // Prevents dismissing of toast on hover
                style: {
                    background: "linear-gradient(to right, #00b09b, #01ff01)",
                },
            }).showToast();
        </script>
    @endif


    <script>
        $(function() {
            setTimeout(function() {
                $(".refresh").fadeOut(3000);
            }, 3000);

        })
    </script>


    @stack('scripts')

</body>

</html>
