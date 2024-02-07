<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Land Lord</title>

    <!-- Styles -->
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/themify-icons.css')}}" rel="stylesheet">
    <link href="{{asset('css/buttons.bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{asset('css/sidebar.css')}}" rel="stylesheet">
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/helper.css')}}" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>

    <div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
        <div class="nano">
            <div class="nano-content">
                <div class="logo"><span>Land Lord</span></a></div>
                <ul>                       
                    <li><a href="{{route('managerDashboard')}}"><i class="fa fa-tachometer"></i> Dashboard </a></li>
                    <li><a href="{{route('managerLogout')}}"><i class="fa fa-sign-out"></i> Logout </a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="float-left">
                        <div class="hamburger sidebar-toggle">
                            <span class="line"></span>
                            <span class="line"></span>
                            <span class="line"></span>
                        </div>
                    </div>
                    <div class="float-right">                        
                        <div class="dropdown dib">
                            <div class="header-icon" data-toggle="dropdown">
                                <span class="user-avatar">{{Auth::user()->first_name}}
                                    <i class="fa fa-caret-down"></i>
                                </span>
                                <div class="drop-down dropdown-profile dropdown-menu dropdown-menu-right">                                    
                                    <div class="dropdown-content-body">
                                        <ul>                                           
                                            <li>
                                                <a href="#">
                                                    <i class="fa fa-key"></i>
                                                    <span>Change Password</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{route('managerLogout')}}">
                                                    <i class="fa fa-sign-out"></i>
                                                    <span>Logout</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @yield('manager')

    <script>
        $('#topdrop').on('hide.bs.dropdown', function (e) {
            if (e.clickEvent) {
            e.preventDefault();
            }
        });
    </script> 

    <script type="text/javascript">
        function hide() {
            var x = document.getElementById("myDIV");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        } 
    </script>

    <script type="text/javascript">
        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }
    </script>
    <!-- jquery vendor -->
    
    {{-- <script src="{{asset('js/jquery.min.js')}}"></script> --}}
    <script src="{{asset('js/jquery.nanoscroller.min.js')}}"></script>
    <!-- nano scroller -->
    <script src="{{asset('js/sidebar.js')}}"></script>
    <script src="{{asset('js/pace.min.js')}}"></script>
    <!-- sidebar -->
    
    <!-- bootstrap -->

    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/scripts.js')}}"></script>
    <!-- scripit init-->
    <script src="{{asset('js/datatables.min.js')}}"></script>
    <script src="{{asset('js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('js/datatables-init.js')}}"></script>



</body>
</html>