<!DOCTYPE html>
<html>
<head data-baseurl="{{ url('/') }}" >
    <meta charset="utf-8" name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{$page_title or 'Admin'}}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{URL::asset('css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{URL::asset('css/AdminLTE.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/_all-skins.min.css')}}">

    <link rel="stylesheet" href="{{URL::asset('css/dataTables.bootstrap.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/datepicker3.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/appointment.css')}}">
    <link rel="stylesheet" href="{{URL::asset('css/select2.min.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


    <!-- REQUIRED JS SCRIPTS -->

    <script type="text/javascript">
        var APP_URL = {!! json_encode(url('/')) !!}
    </script>
</head>

<body class="hold-transition skin-blue sidebar-mini" data-baseurl="{{ url('/') }}">

<!-- jQuery 2.2.3 -->
<script src="{{URL::asset('js/jquery-2.2.3.min.js')}}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{URL::asset('js/bootstrap.min.js')}}"></script>

<script src="{{URL::asset('js/jquery.validate.js')}}"></script>

<script src="{{URL::asset('js/jquery.dataTables.min.js')}}"></script>

<script src="{{URL::asset('js/dataTables.bootstrap.min.js')}}"></script>

<script src="{{URL::asset('js/bootstrap-datepicker.js')}}"></script>

<script src="{{URL::asset('js/select2.full.min.js')}}"></script>

<script src="{{URL::asset('js/custom.js')}}"></script>
<script>
    $.validator.setDefaults({
        highlight: function(element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function(element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function(error, element) {
            if(element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    });
</script>

<div class="wrapper">
        <!-- Main content -->
        <section class="content">
            @if ( Session()->has('flash_message') )
                <div class="alert alert-success alert-dismissable">
                    <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                    {{ session()->get('flash_message') }}
                </div>
            @elseif(session('status'))
                <div class="alert alert-success alert-dismissable">
                    <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                    {{ session('status') }}
                </div>
                @endif
                @yield('content')
        </section>
</div>

</body>
</html>
