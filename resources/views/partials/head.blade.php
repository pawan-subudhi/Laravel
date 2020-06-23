    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700|Work+Sans:300,400,700" rel="stylesheet">

    <link rel="stylesheet" href="{{mix('/css/all.css')}}">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mediaelement@4.2.7/build/mediaelementplayer.min.css">
    
    
    
    <link rel="stylesheet" href="{{asset('external/fonts/flaticon/font/flaticon.css')}}">
  
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script defer src="{{ asset('js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script defer src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(document).ready(function(){
            $('#datepicker').datepicker({
                dateFormat: "yy-mm-dd"
            });
        })
        $( function() {
          $( "#datepicker" ).datepicker();
        } );
    </script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">