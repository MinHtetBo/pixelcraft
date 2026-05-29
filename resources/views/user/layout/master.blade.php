<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>PixelCraft</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset('user_template/lib/lightbox/css/lightbox.min.css')}}" rel="stylesheet">
    <link href="{{asset('user_template/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('user_template/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{asset('user_template/css/style.css')}}" rel="stylesheet">

    <link href="{{asset('user_template/css/custom.css')}}" rel="stylesheet">

</head>

<body>

    <!-- navbar start -->
    <section class="">
        <nav class="navbar navbar-expand-lg bg-body-tertiary shadow-sm fixed-top" style=" background-color: #542344;">
            <div class="container">
                <a href="index.html" class="navbar-brand">
                    <h1 class="display-6" style="color: #BFD1E5;">PixelCraft</h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarCollapse">
                    <div class="navbar-nav mx-auto" >
                        <a href="{{ route('user#home') }}" class="nav-item nav-link " style="color: #BFD1E5;">Shop</a>
                        <a href="{{ route('user#cart') }}" class="nav-item nav-link" style="color: #BFD1E5;">Cart</a>
                        <a href="{{ route('user#myOrder') }}" class="nav-item nav-link" style="color: #BFD1E5;">My Order</a>
                        <a href="{{ route('user#contactPage') }}" class="nav-item nav-link" style="color: #BFD1E5;">Contact</a>

                    </div>
                    <div class="d-flex m-3 me-0">

                        <a href="{{ route('user#cart') }}" class="position-relative me-4 my-auto">
                            <i class="fa fa-shopping-bag fa-2x" style="color: #BFD1E5;"></i>
                        </a>
                        <a href="{{ route('user#myOrder') }}" class="position-relative me-4 my-auto">
                            <i class="fa-solid fa-list-check fa-2x" style="color: #BFD1E5;"></i>
                        </a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle my-auto mt-2" style="color: #BFD1E5;" data-bs-toggle="dropdown">

                                    <img src="{{ asset(auth()->user()->profile == null ? 'defaultImage/defaultProfile.jpg' : 'userProfile/'. auth()->user()->profile) }}" style="width: 50px" class="img-profile  rounded-circle" alt="">
                               <span> {{ auth()->user()->name }}</span>

                            </a>
                            <div class="dropdown-menu m-0 rounded-0" >
                                <a href="{{ route('user#edit') }}" class="dropdown-item my-2" >Edit Profile</a>
                                <a href="{{ route('user#changePasswordPage') }}" class="dropdown-item my-2">Change Password</a>
                                 <a href="{{ route('user#home') }}" class="dropdown-item my-2">Home</a>
                                <a href="#" class="dropdown-item my-2">
                                    <form action="{{ route("logout") }}" method="post">
                                        @csrf
                                        <input type="submit" value="Logout"
                                            class="btn btn-outline-danger rounded w-100 mb-3">
                                    </form>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </nav>
            </div>
        </nav>
    </section>
    <!-- navbar end -->


    @yield("content")




    <!-- Footer Start -->
    <div class="container-fluid text-white-50 footer pt-5 mt-5" style="background-color: #542344;">
        <div class="container py-5">
            <div class="pb-4 mb-4" style="border-bottom: 1px solid #BFD1E5;">
                <div class="row g-4">
                    <div class="col-lg-3">
                        <a href="#">
                            <h1 class=" mb-0" style="color:#BFD1E5;">PixelCraft</h1>
                            <p class=" mb-0" style="color:#BFD1E5;"></p>
                        </a>
                    </div>
                    <div class="col-lg-6">
                        <div class="position-relative mx-auto">
                            <input class="form-control border-0 w-100 py-3 px-4 rounded-pill" type="number"
                                placeholder="Your Email">
                            <button type="submit"
                                class="btn btn-primary border-0 border-secondary py-3 px-4 position-absolute rounded-pill text-white"
                                style="top: 0; right: 0;">Subscribe Now</button>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="d-flex justify-content-end pt-3">
                            <a class="btn   me-2 btn-md-square rounded-circle" style="color:#BFD1E5;" href=""><i
                                    class="fab fa-twitter"></i></a>
                            <a class="btn  me-2 btn-md-square rounded-circle" style="color:#BFD1E5;" href=""><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="btn  me-2 btn-md-square rounded-circle" style="color:#BFD1E5;" href=""><i
                                    class="fab fa-youtube"></i></a>
                            <a class="btn  btn-md-square rounded-circle" style="color:#BFD1E5;" href=""><i
                                    class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-item">
                        <h4 class="text-light mb-3">Why People Like us!</h4>
                        <p class="mb-4">typesetting, remaining essentially unchanged. It was
                            popularised in the 1960s with the like Aldus PageMaker including of Lorem Ipsum.</p>
                        <a href="" class="btn py-2 px-4 rounded-pill " style="background-color:#BFD1E5; color: #542344;" >Read More</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex flex-column text-start footer-item">
                        <h4 class="text-light mb-3">Shop Info</h4>
                        <a class="btn-link" href="">About Us</a>
                        <a class="btn-link" href="">Contact Us</a>
                        <a class="btn-link" href="">Privacy Policy</a>
                        <a class="btn-link" href="">Terms & Condition</a>
                        <a class="btn-link" href="">Return Policy</a>
                        <a class="btn-link" href="">FAQs & Help</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex flex-column text-start footer-item">
                        <h4 class="text-light mb-3">Account</h4>
                        <a class="btn-link" href="">My Account</a>
                        <a class="btn-link" href="">Shop details</a>
                        <a class="btn-link" href="">Shopping Cart</a>
                        <a class="btn-link" href="">Wishlist</a>
                        <a class="btn-link" href="">Order History</a>
                        <a class="btn-link" href="">International Orders</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-item">
                        <h4 class="text-light mb-3">Contact</h4>
                        <p>Address: 1429 Netus Rd, NY 48247</p>
                        <p>Email: Example@gmail.com</p>
                        <p>Phone: +0123 4567 8910</p>
                        <p>Payment Accepted</p>
                        <img src="img/payment.png" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Copyright Start -->
    <div class="container-fluid copyright py-4" style="background-color: #542344;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <span class="" style="color:#BFD1E5;"><a href="#" style="color:#BFD1E5;"><i class="fas fa-copyright  me-2" style="color:#BFD1E5;"></i>PixelCraft</a>, All right reserved.</span>
                </div>
                <div class="col-md-6 my-auto text-center text-md-end text-white">
                    <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                    <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                    <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                    Designed By <a class="border-bottom" style="color:#BFD1E5;" href="https://htmlcodex.com">HTML Codex</a> Distributed By <a
                        class="border-bottom" href="https://themewagon.com" style="color:#BFD1E5;">ThemeWagon</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->



    <!-- Back to Top -->
    <a href="#" class="btn border-3 rounded-circle back-to-top" style="background-color: #BFD1E5;"><i
            class="fa fa-arrow-up"></i></a>

               {{-- sweetalert package --}}
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                <script src="sweetalert2.all.min.js"></script>

                <link rel="stylesheet" href="sweetalert2.min.css">

    <!-- JavaScript Libraries -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('user_template/lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('user_template/lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{asset('user_template/lib/lightbox/js/lightbox.min.js')}}"></script>
    <script src="{{asset('user_template/lib/owlcarousel/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('user_template/js/main.js') }}"></script>


     @yield('script-code');

    <script>
        function loadFile(event){
          var reader = new FileReader()

          reader.onload = function(){
            document.getElementById('output').src = reader.result;
          }

          reader.readAsDataURL(event.target.files[0])
        }
    </script>

</html>
