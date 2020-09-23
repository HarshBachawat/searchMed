<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MediSearch</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('css/medisearch_home.css') }}">
</head>
<body>
<!-- Navigation -->
<nav class="navbar navbar-expand-md navbar-light bg-warning sticky-top">
    <div class="container-fluid">
        <a href="medisearch_home.html" class="navbar-brand"><img src="{{ asset('css/img/medisearch.png') }}" style="width:40px; height:40px;" alt="Error loading"></a>
        <h2 style="color: white;">MediSearch</h2>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=#navbarMenu>
            <span class="navbar-toggler-icon">
            </span>
        </button>
        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a href="#" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="#section-1"  class="nav-link">About</a>
               </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="modal" data-target="#loginModal">LogIn</a>
                </li>
                <li class="nav-item" ">
                    <a data-toggle="modal" data-target="#signupmodal" class="nav-link">SignUp</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">Contact Us</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- LoginModal -->

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Log In</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="md-form">
            <i class="fas fa-user"></i>
            <label for="defaultForm-pass">User</label>
            <select name="usertype" class="form-control selectpicker">
                <option value="Client">Client</option>
                <option value="Chemist">Chemist</option>
            </select>
        </div>
        <div class="md-form">
          <i class="fas fa-envelope prefix grey-text"></i>
          <label for="defaultForm-email">Your email</label>
          <input type="email" class="form-control validate">
        </div>

        <div class="md-form">
          <i class="fas fa-lock prefix grey-text"></i>
          <label for="defaultForm-pass">Your password</label>
          <input type="password" class="form-control validate">
        </div>
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button class="btn btn-default btn-success">Login</button>
      </div>
    </div>
  </div>
</div>

<!-- Sign Up form -->

<div class="modal fade" id="signupmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Sign Up</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="md-form">
            <i class="fas fa-user"></i>
            <label for="defaultForm-pass">User</label>
            <select name="usertype" class="form-control selectpicker">
                <option value="Client">Client</option>
                <option value="Chemist">Chemist</option>
            </select>
        </div>

        <div class="md-form">
          <i class="fas fa-envelope prefix grey-text"></i>
          <label for="defaultForm-email">Your email</label>
          <input type="email" class="form-control validate">
        </div>

        <div class="md-form">
          <i class="fas fa-lock prefix grey-text"></i>
          <label for="defaultForm-pass">Your password</label>
          <input type="password" class="form-control validate">
        </div>

        <div class="md-form">
          <i class="fas fa-lock prefix grey-text"></i>
          <label for="defaultForm-pass">Confirm password</label>
          <input type="password" class="form-control validate">
        </div>

      </div>

      <div class="modal-footer d-flex justify-content-center">
        <button class="btn btn-default btn-success">SignUp</button>
      </div>
    </div>
  </div>
</div>


<!-- search and front part -->

<div class="container-fluid p-0">
    <div class="site-content">
        <div class="d-flex justify-content-center">
            <div class="d-flex flex-column">
                <!-- <h1 class="site-title">MediSearch</h1> -->
                <!-- <div class="container" id="searchbar">
                    <form action="#">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search" name="search">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-success">
                                    <i class="fas fa-search"></i>
                                    <span>Search</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div> -->
            </div>
        </div>
    </div>
</div>

<!-- About section -->
<div class="section-1" id="section-1">
    <div class="container text-center">
        <h1 class="heading-1">About the website</h1>
        <h2 class="heading-2">MediCare</h2>
    </div>

    <div class="row justify-content-center text-center">
        <div class="col-md-4">
        <div class="card ">
            <img src="{{ asset('css/img/drug-store.jpg') }}" alt="Error loading" class="card-img-top">
            <div class="card-body">
                <h1 class="card-title">Find medicines
                </h1>
                <div class="card-text">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.</div>
            </div>
        </div>
        </div>
        <div class="col-md-4">
        <div class="card">
            <img src="{{ asset('css/img/mapslocation.jpg')}}" alt="Error loading" class="card-img-top">
            <div class="card-body">
                <h1 class="card-title">Find medicines
                </h1>
                <div class="card-text">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.</div>
            </div>
        </div>
        </div>
        <div class="col-md-4">
        <div class="card">
            <img src="{{ asset('css//img/shopmed.jpg') }}" alt="Error loading" class="card-img-top">
            <div class="card-body">
                <h1 class="card-title">Find medicines
                </h1>
                <div class="card-text">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.</div>
            </div>
        </div>
        </div>
    </div>
</div>

<!-- Content -->
<div class="container-fluid padding bg-light">
    <hr class="my-4">
    <div class="row text-center padding">
        <div class="col-12">
            <h2>Connect</h2>
        </div>
        <div class="col-12 social padding">
            <a href=""><i class="fab fa-facebook"></i>
            </a>
            <a href=""><i class="fab fa-twitter"></i>
            </a>
            <a href=""><i class="fab fa-google-plus-g"></i>
            </a>
            <a href=""><i class="fab fa-instagram"></i>
            </a>
            <a href=""><i class="fab fa-youtube"></i>
            </a> 
        </div>
    </div>
</div>
<!-- <div class="container-fluid bg-dark">
    <hr style="margin: 0 0 10px 0;">
    <h5 style="color: aliceblue;">&copy;MediCare</h5>
    <hr style="margin: 10px 0 0 0;">
</div> -->
<hr class="my-2">
<div class="footer-copyright text-center py-3">© 2018 Copyright:
        <a href="#">MediSearch.com</a>
      </div>
</body>
</html>