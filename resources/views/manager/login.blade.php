<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin - Login</title>

    <!-- Styles -->
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/themify-icons.css')}}" rel="stylesheet">
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/helper.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
</head>
<body>

    <div class="unix-login">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="login-content">                        
                        <div class="login-form">
                            @if(session()->has('error'))
                            <div class="alert alert-danger" id="myDIV" role="alert" style="width: 100%; float: left;">
                                <strong>{{session()->get('error')}}</strong>                              
                            </div>
                            @endif
                            
                            <form method="POST" action="{{url('/manager/logged')}}">
                                @csrf
                                <div class="form-group">
                                    <label>Email Address <span style='color: red'>*</span></label>
                                    <input type="email" class="form-control" name="email" placeholder="Email">
                                    <p class="text-danger">@error('email') {{$message}}@enderror</p>
                                </div>
                                <div class="form-group">
                                    <label>Password <span style='color: red'>*</span></label>
                                    <input type="password" class="form-control" name="password" placeholder="Password">
                                    <p class="text-danger">@error('password') {{$message}}@enderror</p>
                                </div> 
                                
                                <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Sign In</button>                                
                               
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>