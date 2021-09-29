<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ibilling</title>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    {{-- <link rel="stylesheet" href="assets/css/responsive.css"> --}}
    {{-- <link rel="stylesheet" href="assets/css/style.css"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
</head>

<body>

    <!--    banner area-->
    <section id="banner">

        <nav class="navbar navbar-expand-lg navbar-light bg-transparent main-menu sticky-nav">
            <div class="container">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                   <i class="fas fa-bars bars"></i>
                   
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav m-auto mb-lg-0 menu-item">
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/')}}">Home</a>
                        </li>
                            <a class="nav-link" href="{{url('login/admin')}}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/')}}">Pricing</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/')}}">Docs</a>
                        </li>

                    </ul>
                    <ul class="navbar-nav ml-auto mb-lg-0 menu-icon">
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fab fa-facebook-f"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fab fa-twitter"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fab fa-github"></i></a>
                        </li>


                    </ul>
                </div>


            </div>
        </nav>










        <div class="container">
            <div class="row">
                <div class="col-md-4 banner-text-col">
                    <h2 class="banner-text mb-0">
                        Free dashboard template for your <span>user experiences.</span>
                    </h2>
                    <button type="button" class="btn banner-btn">Register Now</button>
                    
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-6">
                    <img src="{{url('assets/image/banner-img.png')}}" class="w-100" alt="no">
                </div>
            </div>
        </div>
    </section>
    <!--    banner area-->


    <!--dashboard demo area-->
    <section id="dashboard-demo">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="dashboard-demo-tittle">
                        Dashboard Demo
                    </h2>
                    <p class="dashboard-demo-text">
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Perferendis, quibusdam?
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card" style="">
                    <a href="#">
                            <img src="{{url('assets/image/dashboard.png')}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="dash-demo-name">With Sidemenu</p>
                        </div>
                    </a>
                    </div>
                </div> 
                <div class="col-md-4 mb-4">
                    <div class="card demo-last-card" style="">
                       <a href="#">
                            <img src="{{url('assets/image/collapsed-dashboard.png')}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="dash-demo-name">Without Sidemenu</p>
                        </div>
                       </a>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                  <div class="card demo-last-card" style="">
                     <a href="#">
                          <img src="{{url('assets/image/customerlist.png')}}" class="card-img-top" alt="...">
                      <div class="card-body">
                          <p class="dash-demo-name">Customer List</p>
                      </div>
                     </a>
                  </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 mb-4">
                  <div class="card" style="">
                  <a href="#">
                          <img src="{{url('assets/image/create-customer.png')}}" class="card-img-top" alt="...">
                      <div class="card-body">
                          <p class="dash-demo-name">Create Customer</p>
                      </div>
                  </a>
                  </div>
              </div>
              <div class="col-md-4 mb-4">
                  <div class="card demo-last-card" style="">
                     <a href="#">
                          <img src="{{url('assets/image/user-profile.png')}}" class="card-img-top" alt="...">
                      <div class="card-body">
                          <p class="dash-demo-name">User Profile</p>
                      </div>
                     </a>
                  </div>
              </div>
              <div class="col-md-4 mb-4">
                <div class="card demo-last-card" style="">
                   <a href="#">
                        <img src="{{url('assets/image/print-setting.png')}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="dash-demo-name">Print Setting</p>
                    </div>
                   </a>
                </div>
            </div>
          </div>

        </div>
    </section>
    <!--dashboard demo area-->


    {{-- Pricing --}}
    <section id="pricing-section">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h2 class="dashboard-demo-tittle">
                    Our Best Pricing
                  </h2>
                  <p class="dashboard-demo-text">
                      Lorem ipsum dolor sit, amet consectetur adipisicing elit. Perferendis, quibusdam?
                  </p>
              </div>
          </div>
          <div class="row pricing">
              <div class="col-md-3 mb-3">
             
        <div class="card rounded-3">
          <div class="card-header py-3">
            <h4 class="my-0 fw-normal">Free</h4>
          </div>
          <div class="card-body">
            <h1 class="card-title pricing-card-title">$0<small class="text-muted fw-light">/mo</small></h1>
            <ul class="list-unstyled mt-4 mb-5">
              <li><i class="fas fa-check"></i> 10 users included</li>
              <li><i class="fas fa-check"></i> 2 GB of storage</li>
              <li><i class="fas fa-check"></i> Email support</li>
              <li><i class="fas fa-check"></i> Help center access</li>
              <li><i class="fas fa-check"></i> 10 users included</li>
              <li><i class="fas fa-check"></i> 2 GB of storage</li>
              <li><i class="fas fa-check"></i> Email support</li>
              <li><i class="fas fa-check"></i> Help center access</li>
            </ul>
            <a class="pricing-btn" href="{{url('/')}}">Get Started</a>
          </div>
        </div>
      
              </div> 
              <div class="col-md-3 mb-3">
              
                <div class="card rounded-3">
                  <div class="card-header py-3">
                    <h4 class="my-0 fw-normal">Free</h4>
                  </div>
                  <div class="card-body">
                    <h1 class="card-title pricing-card-title">$0<small class="text-muted fw-light">/mo</small></h1>
                    <ul class="list-unstyled mt-4 mb-5">
                      <li><i class="fas fa-check"></i> 10 users included</li>
                      <li><i class="fas fa-check"></i> 2 GB of storage</li>
                      <li><i class="fas fa-check"></i> Email support</li>
                      <li><i class="fas fa-check"></i> Help center access</li>
                      <li><i class="fas fa-check"></i> 10 users included</li>
                      <li><i class="fas fa-check"></i> 2 GB of storage</li>
                      <li><i class="fas fa-check"></i> Email support</li>
                      <li><i class="fas fa-check"></i> Help center access</li>
                    </ul>
                    <a class="pricing-btn" href="{{url('/')}}">Get Started</a>
                  </div>
                </div>
      
              </div>
              <div class="col-md-3 mb-3">
              
                <div class="card rounded-3">
                  <div class="card-header py-3">
                    <h4 class="my-0 fw-normal">Free</h4>
                  </div>
                  <div class="card-body">
                    <h1 class="card-title pricing-card-title">$0<small class="text-muted fw-light">/mo</small></h1>
                    <ul class="list-unstyled mt-4 mb-5">
                      <li><i class="fas fa-check"></i> 10 users included</li>
                      <li><i class="fas fa-check"></i> 2 GB of storage</li>
                      <li><i class="fas fa-check"></i> Email support</li>
                      <li><i class="fas fa-check"></i> Help center access</li>
                      <li><i class="fas fa-check"></i> 10 users included</li>
                      <li><i class="fas fa-check"></i> 2 GB of storage</li>
                      <li><i class="fas fa-check"></i> Email support</li>
                      <li><i class="fas fa-check"></i> Help center access</li>
                    </ul>
                    <a class="pricing-btn" href="{{url('/')}}">Get Started</a>
                  </div>
                </div>
      
            </div>
            <div class="col-md-3 mb-3">
           
              <div class="card rounded-3">
                <div class="card-header py-3">
                  <h4 class="my-0 fw-normal">Free</h4>
                </div>
                <div class="card-body">
                  <h1 class="card-title pricing-card-title">$0<small class="text-muted fw-light">/mo</small></h1>
                  <ul class="list-unstyled mt-4 mb-5">
                    <li><i class="fas fa-check"></i> 10 users included</li>
                    <li><i class="fas fa-check"></i> 2 GB of storage</li>
                    <li><i class="fas fa-check"></i> Email support</li>
                    <li><i class="fas fa-check"></i> Help center access</li>
                    <li><i class="fas fa-check"></i> 10 users included</li>
                    <li><i class="fas fa-check"></i> 2 GB of storage</li>
                    <li><i class="fas fa-check"></i> Email support</li>
                    <li><i class="fas fa-check"></i> Help center access</li>
                  </ul>
                  <a class="pricing-btn" href="{{url('/')}}">Get Started</a>
                </div>
              </div>
      
          </div>
          </div>
      
        </div>

      </div>
  </section>
       {{-- Pricing --}}

{{-- contact --}}
<section id="contact">
  <div class="container">
    
   <div class="row">
     <div class="col-md-6">
      <h2 class="dashboard-demo-tittle text-start">
        Contact Us
    </h2>
    <p class="mb-0">
      Our Address
    </p>
    
     </div>
     <div class="col-md-6"></div>
   </div>
 
  
      </div>
  
    </div>

  </div>
</section>
{{-- contact --}}


    <!--footer area-->
    <section id="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="footer-logo align-self-center">
                        <h1 class="mb-0">
                            Logo
                        </h1>
                    </div>
                </div>
                <div class="col-md-9 align-self-center">

                  <ul class="footer-menu">
                    <li>
                        <a href="{{url('/')}}">Home</a>
                    </li>
                    <li>
                        <a href="{{url('login/admin')}}">Login</a>
                    </li>
                    <li>
                        <a href="{{url('/')}}">Pricing</a>
                    </li>
                    <li>
                        <a href="{{url('/')}}">Docs</a>
                    </li>

                </ul>

                </div>
            </div>


            <div class="copy-right-area">
                <div class="row">
                    <div class="col-md-6">
                        <p class="all-rights mb-0">
                            All Right Reserved.
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p class="created mb-0">
                            Created by: <a href="#">Virtuanic</a>
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!--footer area-->

    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}"> --}}
    <script src="{{ asset('assets/js/jquery-1.12.4.min.js')}}"></script>
    <script src="{{ asset('assets/js/popper.min.js')}}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('assets/js/main.js')}}"></script>
</body>

</html>
