<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    {{ get_title() }}
    {{ stylesheet_link(['globals/pintuer.css']) }}
    {{ javascript_include('globals/jquery-1.7.2.min.js') }}
    {{ javascript_include('globals/pintuer.js') }}
    {{ javascript_include('globals/respond.js') }}
    {{ javascript_include('plugins/layer/layer.js') }}
    {{ javascript_include('globals/app.js') }}

    {{ stylesheet_link(['frontend/css/reset.css']) }}
    {{ stylesheet_link(['frontend/css/main.css']) }}
    {{ javascript_include('frontend/js/global.js') }}

</head>

<body class="mainCenter" >

{{ content() }}

</body>
</html>