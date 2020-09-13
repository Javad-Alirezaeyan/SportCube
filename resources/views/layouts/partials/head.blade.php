<?php
$pluginPath = "theme/assets/plugins/";
$themePath = "theme/";
?>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script >
    window.Laravel =
    <?php echo json_encode([
        'csrfToken' => csrf_token(),
        'baseUrl' => URL::to('/')
    ]); ?>
</script>
<!-- Favicon icon -->
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset("favicon.ico") }}">
<link href="{{asset("css/app.css")}}" rel="stylesheet" />
<title>@yield('title')</title>



