<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Dashbord | Life Saving Victoria - Public Portal</title>
  <link type="image/png" href="images/favicon.png" rel="icon" />

  <link rel="stylesheet" type="text/css" href="{{ asset('site/css/main.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset('site/css/ui-styles.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset('site/css/bulma.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset('site/css/jquery.modal.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset('site/css/bulma-steps.min.css')}}">
  <link rel="stylesheet" href="{{ asset('site/css/jquery-ui.css')}}">
  <!-- <link rel="stylesheet" href="css/jquery.dataTables.min.css"> -->

  <script src="{{ asset('site/js/jquery-3.4.1.js')}}"></script>
  <script src="{{ asset('site/js/jquery-ui.js')}}"></script>
  <script defer src="{{ asset('site/js/all.js')}}"></script>
  <script src="{{ asset('site/js/custom.js')}}"></script>
  <script src="{{ asset('site/js/jquery.modal.min.js')}}"></script>
  <script src="{{ asset('site/js/jquery.dataTables.min.js')}}"></script>
  
</head>
<body>
  <div class="login-page">
    <div class="login-container">
      <div class="inner">
<!-- social icon -->
        <ul class="logo-bar">
          <li class="brand-logo"><img src="{{ asset('site/images/logo.png')}}"></li>
          @foreach($social_icons as $social_icon)
          <li class="social-icon">
            <a href="{{$social_icon->url}}">
              <span class="{{$social_icon->class_one}}">
                <i class="{{$social_icon->class_two}}"></i>
              </span> 
            </a>
          </li>
          @endforeach
         
        </ul>

        <div class="login-form">
          <form action="{{url('dologin')}}" method="POST" id="login-frm">
            @csrf
            @if( Session::get('message')!=NULL)
            <p class="txt-support-red txt-center"><?php echo Session::get('message'); ?></p>
            @endif
              @if (count($errors) > 0)
            
            <ul>
            @foreach ($errors->all() as $error)
            <li class="txt-support-red">{{ $error }}</li>
            @endforeach
            </ul>
            
            @endif
            <div class="field">
              <div class="control">
                <input class="input" type="text" placeholder="User Name" name="username" id="username">
              </div>
            </div>
            <div class="field">
              <div class="control">
                <input class="input" type="password" placeholder="Password" name="password" id="password">
              </div>
            </div>

            <div class="btn-container">
              <div class="columns  is-mobile">
                <div class="column is-half txt-left">
                  <a class="button delete-btn regular-btn">Reset</a>
                </div>
                <div class="column is-half txt-right">
                  <!-- <a class="button normal-btn regular-btn"></a> -->
                  <button class="button normal-btn regular-btn" id="ChkSubmit">Login</button>
                </div>
              </div>
              <div class="columns">
                <div class="column txt-center">
                  <a class="button normal-btn full-btn">Register</a>
                </div>
              </div>
            </div>

          </form>  
        </div>

      </div>
    </div>
  </div>
 <script>
    $(document).ready(function () {
      // here update the member data
      $("#login-frm").unbind('submit').bind('submit', function() {

            // remove error messages
           
               $(".txt-support-red").remove();
            var form = $(this);


            // validation
            var username= $("#username").val();
            var password= $("#password").val();
           
  
// check feald empty

            if(username == "") {
                 $("#username").closest('.input').addClass('is-danger');
                $("#username").after('<p class="txt-support-red">The  User Name field is required</p>');
            } else {
                $("#username").closest('.input').removeClass('is-danger');
                 $("#username").closest('.is-success').addClass('has-success');
            }
      
      
       if(password == "") {
                  $("#password").closest('.input').addClass('is-danger');
                $("#password").after('<p class="txt-support-red">The Password  field is required</p>');
            } else {
                $("#password").closest('.input').removeClass('is-danger');
                 $("#password").closest('.is-success').addClass('has-success');
            }
      
// if user name password valid login

            if(username,password) {

              $('#login-frm').submit();
            } 

            return false;
        });
    });

</script>

</body>
</html>