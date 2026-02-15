@extends('web.layouts.app')

@section('content')
    <style>
        .marginMain {
            margin-left: 270px;
        }
    </style>
    <!-- Full converted content from profile-bootstrap-master/index.html -->
    <div id="page-top">

        <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
            <a class="navbar-brand js-scroll-trigger" href="#page-top">
                <span class="d-block d-lg-none  mx-0 px-0"><img src="{{ asset('web/img/logo-white.png') }}" alt=""
                        class="img-fluid"></span>
                <span class="d-none d-lg-block">
                    <img class="img-fluid img-profile rounded-circle mx-auto mb-2 " src="{{ asset('web/img/main.jpg') }}"
                        alt="">
                </span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#experience">Experience</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#portfolio">Portfolio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#skills">Skills</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#awards">Awards</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container-fluid p-0" style="padding-top: 70px;">

            <!-- ABOUT -->
            <section class="resume-section p-3 p-lg-5 d-flex d-column marginMain" id="about">
                <div class="my-auto mt-5">
                    <img src="{{ asset('web/img/logo-s.png') }}" class="img-fluid mb-3 mt-5" alt="">
                    <h1 class="mb-0">{{ trns('kariem') }}
                        <span class="text-primary">{{ trns('ibrahiem') }}</span>
                    </h1>
                    <div class="subheading mb-5">{{ trns('THE NEXT BIG IDEA IS WAITING FOR ITS NEXT BIG CHANGER WITH ') }}
                        <a href="#">{{ trns('THEMSBIT') }}</a>
                    </div>
                    <p class="mb-5" style="max-width: 500px;">
                        {{ trns('I am experienced in Laravel frameworks to provide a  high level systems with perfect performance. Iterative approaches to corporate strategy foster collaborative thinking to further the overall value proposition.') }}
                    </p>
                    <ul class="list-inline list-social-icons mb-0">
                        <li class="list-inline-item">
                            <a href="https://www.facebook.com/kemo.ibrahem.98/" target="_blank">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-facebook fa-stack-1x fa-inverse"> </i>
                                </span>
                            </a>
                        </li>
                        {{-- <li class="list-inline-item">
                            <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li> --}}
                        <li class="list-inline-item">
                            <a href="https://www.linkedin.com/in/kariem-ibrahiem-903a0b2a7/" target="_blank">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-linkedin fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="https://github.com/kariemibrahiem" target="_blank">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-github fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </section>

            <!-- EXPERIENCE -->
            <section class="resume-section p-3 p-lg-5 marginMain" id="experience">
                <div class="row my-auto">
                    <div class="col-12">
                        <h2 class="text-center">{{ trns('Experience') }}</h2>
                        <div class="mb-5 heading-border"></div>
                    </div>
                    @foreach($experiences as $experience)
                    <div class="resume-item col-md-6 col-sm-12 ">
                        <div class="card mx-0 p-4 mb-5"
                            style="border-color: {{ $experience->border_color }}; box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.21);">
                            <div class=" resume-content mr-auto">
                                <h4 class="mb-3"><i class="fa {{ $experience->icon_class }} mr-3 text-info"></i>
                                    {{ trns($experience->title) }}</h4>
                                <p>
                                    {{ trns($experience->description) }}
                                </p>


                            </div>
                            <div class="resume-date text-md-right">
                                <span class="text-primary">{{ trns($experience->start_date . ' - ' . $experience->end_date) }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </section>

            <!-- PORTFOLIO -->
            <section class="resume-section p-3 p-lg-5 d-flex marginMain flex-column marginMain" id="portfolio">
                <div class="row my-auto">
                    <div class="col-12">
                        <h2 class="  text-center">Portfolio</h2>
                        <div class="mb-5 heading-border"></div>
                    </div>
                    <div class="col-md-12">
                        <!-- <div class="port-head-cont">
                            <button class="btn btn-general btn-green filter-b" data-filter="all">All</button>
                            <button class="btn btn-general btn-green filter-b" data-filter="consulting">Web
                                Design</button>
                            <button class="btn btn-general btn-green filter-b" data-filter="finance">Mobile Apps</button>
                            <button class="btn btn-general btn-green filter-b" data-filter="marketing">Graphics
                                Design</button>
                        </div> -->
                    </div>
                </div>
                <div class="row my-auto">
                    @foreach($portfolios as $portfolio)
                    <div class="col-sm-4 portfolio-item filter {{ $portfolio->category }}">
                        <a class="portfolio-link" href="{{ $portfolio->url }}" target="_blank">
                            <div class="caption-port">
                                <div class="caption-port-content" style="font-size: 13px;">
                                    {{ trns($portfolio->description) }}
                                </div>
                            </div>
                            <img class="img-fluid" src="{{ asset($portfolio->image) }}" alt="{{ $portfolio->title }}">
                        </a>
                    </div>
                    @endforeach
                </div>
            </section>

            <!-- SKILLS -->
            <section class=" d-flex flex-column marginMain" id="skills">
                <div class="p-lg-5 p-3 skill-cover">
                    <h3 class="text-center text-white">Coding Skills</h3>
                    <div class="row text-center my-auto ">
                        @foreach($skills as $skill)
                        <div class="col-md-3 col-sm-6">
                            <div class="skill-item">
                                @if($skill->icon_type === 'image')
                                    <img src="{{ asset($skill->icon_value) }}" alt="{{ $skill->name }}"
                                        style="width: 80px; height: 80px;">
                                @else
                                    <i class="{{ $skill->icon_value }} fa-5x"></i>
                                @endif
                                <p>{{ $skill->name }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <!-- AWARDS -->
            <section class="resume-section p-3 p-lg-5 marginMain d-flex flex-column" id="awards">
                <div class="row my-auto">
                    <div class="col-12">
                        <h2 class="  text-center">Techs</h2>
                        <div class="mb-5 heading-border"></div>
                    </div>
                    <div class="main-award" id="award-box">
                        @foreach($techs as $tech)
                        <div class="award">
                            <div class="award-icon"></div>
                            <div class="award-content">
                                <h5 class="title">{{ $tech->title }}</h5>
                                @if($tech->description)
                                <p class="description">
                                    {{ $tech->description }}
                                </p>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <!-- CONTACT -->
            <section class="resume-section p-3 p-lg-5  marginMain d-flex flex-column">
                <div class="row my-auto" id="contact">
                    <div class="col-md-8">
                        <div class="contact-cont">
                            <h3>CONTACT Us</h3>
                            <div class="heading-border-light"></div>
                            <p></p>

                            <div class="row mt-5">
                                <div class="col-md-6 col-sm-12">
                                    <div class="contact-cont2">
                                        <div class="contact-phone contact-side-desc contact-box-desc">
                                            <h3><i class="fa fa-phone cl-atlantis fa-2x"></i> Phone</h3>
                                            <p>+2001282119707</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <div class="contact-cont2">
                                        <div class="contact-mail row contact-side-desc contact-box-desc">
                                            <div class="col-md-6">
                                                <h3><i class="fa fa-envelope-o cl-atlantis fa-2x"></i> Email</h3>
                                                <address class="address-details-f">
                                                    Email: <a href="mailto:info@themsbit.com"
                                                        class="">kariemibrahiem110@gmail.com</a>
                                                </address>
                                            </div>
                                            <div class="col-md-6">
                                                <ul class="list-inline social-icon-f top-data">
                                                    <li><a href="https://www.facebook.com/kemo.ibrahem.98/"
                                                            target="_empty"><i class="fa top-social fa-facebook"
                                                                style="color: #4267b2; border-color:#4267b2;"></i></a>
                                                    </li>
                                                    <li><a href="mailto:kariemibrahiem110@gmail.com" target="_empty"><i
                                                                class="fa top-social fa-google-plus"
                                                                style="color: #e24343; border-color:#e24343;"></i></a>
                                                    </li>
                                                </ul>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="row con-form">
                            <div class="col-md-12">
                                <input type="text" name="full-name" placeholder="Full Name" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <input type="text" name="email" placeholder="Email Id" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <input type="text" name="subject" placeholder="Subject" class="form-control">
                            </div>
                            <div class="col-md-12">
                                <textarea name="" id=""></textarea>
                            </div>
                            <div class="col-md-12 sub-but"><button class="btn btn-general btn-white"
                                    role="button">Send</button></div>
                        </div> -->
                    </div>
                    
                </div>
            </section>

            <section class=" d-flex  marginMain flex-column" id="maps">
                <div id="map">
                    <div class="map-responsive">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d6030.418742494061!2d31.0126!3d30.5549!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2seg!4v1471908546569"
                            width="600" height="450" frameborder="0" style="border:0" allowfullscreen>
                        </iframe>

                    </div>
                </div>
            </section>

        </div>

        <!-- PORTFOLIO MODALS -->
        <!-- modal markup copied from template -->
        <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="close-modal" data-dismiss="modal">
                        <div class="lr">
                            <div class="rl"></div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="modal-body">
                                <div class="title-bar">
                                    <div class="col-md-12">
                                        <h2 class="text-center">Our Project</h2>
                                        <div class="heading-border"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <img class="img-fluid img-centered"
                                            src="{{ asset('web/img/portfolio/p-1.jpg') }}" alt="">
                                    </div>
                                    <div class="col-md-6">
                                        <p>Our new Project every processes had become fragmented; meaning quality and
                                            service were inconsistent.</p>
                                        <ul class="list-inline item-details">
                                            <li>Client:
                                                <strong>
                                                    <a href="#">Techs Soft</a>
                                                </strong>
                                            </li>
                                            <li>Date:
                                                <strong>
                                                    <a href="#">April 2018</a>
                                                </strong>
                                            </li>
                                            <li>Service:
                                                <strong>
                                                    <a href="#">Web Development</a>
                                                </strong>
                                            </li>
                                        </ul>
                                        <button class="btn btn-general btn-white" type="button" data-dismiss="modal">
                                            <i class="fa fa-times"></i> Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional modals (2..9) omitted for brevity but can be added similarly if needed -->

        <!-- Global javascript -->
        <script src="{{ asset('web/js/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('web/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('web/js/jquery-easing/jquery.easing.min.js') }}"></script>
        <script src="{{ asset('web/js/counter/jquery.waypoints.min.js') }}"></script>
        <script src="{{ asset('web/js/counter/jquery.counterup.min.js') }}"></script>
        <script src="{{ asset('web/js/custom.js') }}"></script>
        <script>
            $(document).ready(function() {

                $(".filter-b").click(function() {
                    var value = $(this).attr('data-filter');
                    if (value == "all") {
                        $('.filter').show('1000');
                    } else {
                        $(".filter").not('.' + value).hide('3000');
                        $('.filter').filter('.' + value).show('3000');
                    }
                });

                if ($(".filter-b").removeClass("active")) {
                    $(this).removeClass("active");
                }
                $(this).addClass("active");
            });

            // SKILLS
            $(function() {
                $('.counter').counterUp({
                    delay: 10,
                    time: 2000
                });

            });
        </script>

    </div>
@endsection
