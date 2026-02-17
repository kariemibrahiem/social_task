<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title') social platform</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="{{ asset('news-master/site.webmanifest') }}">
    <link rel="shortcut icon" type="image/x-xicon" href="{{ asset('news-master/assets/img/favicon.ico') }}">

    <link rel="stylesheet" href="{{ asset('news-master/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('news-master/assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('news-master/assets/css/ticker-style.css') }}">
    <link rel="stylesheet" href="{{ asset('news-master/assets/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('news-master/assets/css/slicknav.css') }}">
    <link rel="stylesheet" href="{{ asset('news-master/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('news-master/assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('news-master/assets/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('news-master/assets/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('news-master/assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('news-master/assets/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('news-master/assets/css/style.css') }}">
</head>

<body>

    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="{{ asset('news-master/assets/img/logo/logo.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>

    <header>

        <div class="header-area">
            <div class="main-header ">

                <div class="header-mid gray-bg">

                </div>
                <div class="header-bottom header-sticky">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-xl-8 col-lg-8 col-md-12 header-flex">

                                <div class="sticky-logo">
                                    <a href="/"><img src="{{ asset('news-master/assets/img/logo/logo.png') }}" alt=""></a>
                                </div>

                                <div class="main-menu d-none d-md-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a href="{{ route('front.home') }}">Home</a></li>
                                            <li><a href="{{ route('front.friends') }}">friends</a></li>
                                            <li><a href="{{ route('front.connections') }}">connections</a></li>
                                            <li><a href="{{ route('front.posts') }}">posts</a></li>
                                            <li><a href="{{ route('front.notifications') }}">Notification</a></li>

                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4">
                                <div class="header-right f-right d-none d-lg-block">
                                    @auth
                                    <span class="mr-10"><a href="{{ route('front.profile.edit') }}" style="color:inherit;text-decoration:none;cursor:pointer;">{{ auth()->user()->name }}</a></span>
                                    <a href="#" data-toggle="modal" data-target="#createPostModal" class="btn btn-sm btn-light mr-10" style="border-radius:20px;">+ Post</a>
                                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="genric-btn danger circle">Logout</a>
                                    <form id="logout-form" action="{{ route('front.logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    @else
                                    <a href="{{ route('front.login') }}" class="genric-btn danger-border circle mr-10">Login</a>
                                    <a href="{{ route('front.register') }}" class="genric-btn danger circle">Register</a>
                                    @endauth
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mobile_menu d-block d-md-none"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </header>

    <main>
        @yield('content')
    </main>

    <footer>

        <div class="footer-main footer-bg" style="padding: 30px 0;">
            <div class="container">
                <div class="row align-items-center">

                    <div class="col-lg-6 col-md-6">
                        <div class="footer-logo mb-3">
                            <a href="/"><img src="{{ asset('news-master/assets/img/logo/logo2_footer.png') }}" alt="" style="max-height: 40px;"></a>
                        </div>
                        <p style="color: #bfa3a3; font-size: 14px; line-height: 1.6;">
                            A simple social networking platform built with Laravel.<br>
                            Connect, share posts, and interact with friends.
                        </p>
                    </div>

                    <div class="col-lg-6 col-md-6 text-right">
                        @if(isset($admin))
                        <div class="d-flex justify-content-end align-items-center">
                            <div class="text-right mr-3" style="color: #bfa3a3; font-size: 14px;">
                                <h6 style="color: #fff; margin-bottom: 5px;">{{ $admin->user_name }}</h6>
                                <span class="d-block">{{ $admin->email }}</span>
                                <span class="d-block">{{ $admin->phone }}</span>
                            </div>
                            <div>
                                <img src="{{ $admin->image ? asset($admin->image) : asset('news-master/assets/img/logo/logo.png') }}"
                                    alt="Admin"
                                    class="rounded-circle"
                                    style="width: 50px; height: 50px; object-fit: cover; border: 2px solid #fff;">
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </footer>

    <div class="search-model-box">
        <div class="d-flex align-items-center h-100 justify-content-center">
            <div class="search-close-btn">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Searching key.....">
            </form>
        </div>
    </div>

    <script src="{{ asset('news-master/assets/js/vendor/modernizr-3.5.0.min.js') }}"></script>

    <script src="{{ asset('news-master/assets/js/vendor/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('news-master/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('news-master/assets/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('news-master/assets/js/jquery.slicknav.min.js') }}"></script>

    <script src="{{ asset('news-master/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('news-master/assets/js/slick.min.js') }}"></script>

    <script src="{{ asset('news-master/assets/js/gijgo.min.js') }}"></script>

    <script src="{{ asset('news-master/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('news-master/assets/js/animated.headline.js') }}"></script>
    <script src="{{ asset('news-master/assets/js/jquery.magnific-popup.js') }}"></script>

    <script src="{{ asset('news-master/assets/js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset('news-master/assets/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('news-master/assets/js/jquery.sticky.js') }}"></script>

    <script src="{{ asset('news-master/assets/js/contact.js') }}"></script>
    <script src="{{ asset('news-master/assets/js/jquery.form.js') }}"></script>
    <script src="{{ asset('news-master/assets/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('news-master/assets/js/mail-script.js') }}"></script>
    <script src="{{ asset('news-master/assets/js/jquery.ajaxchimp.min.js') }}"></script>

    <script src="{{ asset('news-master/assets/js/plugins.js') }}"></script>
    <script src="{{ asset('news-master/assets/js/main.js') }}"></script>

    @auth
    <div class="modal fade" id="createPostModal" tabindex="-1" role="dialog" aria-labelledby="createPostModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('front.posts.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createPostModalLabel">Create New Post</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="postContent">What's on your mind?</label>
                            <textarea class="form-control" id="postContent" name="content" rows="4" required placeholder="Write something..."></textarea>
                        </div>
                        <div class="form-group">
                            <label for="postImage">Image (optional)</label>
                            <input type="file" class="form-control-file" id="postImage" name="image" accept="image/*">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Publish</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endauth

</body>

</html>