<!DOCTYPE html>
<html lang="">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <title>
        @hasSection('title')
            @yield('title')
        @else
            {{ $setting['seo_title'] ?? 'Default Site Title' }}
        @endif
    </title>

    <meta name="keywords" content="@yield('meta_description')">
    <meta name="description" content="@yield('meta_description')">
    <meta property="og:title" content="@yield('meta_og_title')">
    <meta property="og:description" content="@yield('meta_og_description')">
    <meta property="og:image" content="@yield('meta_og_image')">
    <meta name="twitter:title" content="@yield('meta_tw_title')">
    <meta name="twitter:description" content="@yield('meta_tw_description')">
    <meta name="twitter:image" content="@yield('meta_tw_image')">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link rel="icon" href="{{ asset($setting['site_favicon']) }}" type="image/png">
    <link href="{{ asset('frontend/assets/css/styles.css') }}" rel="stylesheet">
</head>


<body>
    {{-- Global Variable --}}
    @php
        $socialLinks = \App\Models\SocialLink::where('status', 1)->get();
        $footerInfo = \App\Models\FooterInfo::where('language', getLanguage())->first();
        $footerGridOne = \App\Models\FooterGridOne::where([
            'status' => 1,
            'language' => getLanguage(),
        ])->get();
        $footerGridTwo = \App\Models\FooterGridTwo::where([
            'status' => 1,
            'language' => getLanguage(),
        ])->get();
        $footerGridThree = \App\Models\FooterGridThree::where([
            'status' => 1,
            'language' => getLanguage(),
        ])->get();

    @endphp

    <!-- Header news -->
    @include('frontend.section.header')
    <!-- End Header news -->

    @yield('contain')

    @include('frontend.section.footer')

    <a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up"></i></a>

    <script type="text/javascript" src="{{ asset('frontend/assets/js/index.bundle.js') }}"></script>
    @include('sweetalert::alert')
    {{-- Sweet alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('scripts')

    <script>
        $(document).ready(function() {

            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // Change Language
            $('#site-language').on('change', function() {
                let languageCode = $(this).val();
                $.ajax({
                    method: 'GET',
                    url: "{{ route('language') }}",
                    data: {
                        language_code: languageCode
                    },
                    success: function(data) {
                        if (data.status === 'success') {
                            window.location.reload();
                        }

                    },
                    error: function(data) {
                        console.log(data);
                    }
                })
            });


            //newsletter mail

            $('.newsletter-form').on('submit', function(e) {
                e.preventDefault();

                let $form = $(this);
                let $button = $form.find('.newsletter-button');
                let originalText = $button.text();
                $.ajax({
                    method: 'POST',
                    url: "{{ route('subscribe-newsletter') }}",
                    data: $form.serialize(),
                    beforeSend: function() {
                        $button.text('Loading...').attr('disabled', true);
                    },
                    success: function(data) {
                        $form.trigger('reset');
                        if (data.success === 'success') {
                            Toast.fire({
                                icon: 'success',
                                title: data.message
                            });
                        }
                    },
                    error: function(data) {
                        if (data.status === 422) {
                            let errors = data.responseJSON.errors;
                            $.each(errors, function(index, value) {
                                Toast.fire({
                                    icon: 'error',
                                    title: value[0]
                                });
                            })
                        }
                    },
                    complete() {
                        $button.text(originalText).prop('disabled', false);
                    }



                })
            })


        });
    </script>
</body>

</html>
