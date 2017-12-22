<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    {{ get_title() }}
    {{ javascript_include('globals/jquery-1.7.2.min.js') }}
    {{ javascript_include('plugins/layer/layer.js') }}
</head>

<body class="mainCenter" >

{{ content() }}

</body>
</html>

<script type="text/javascript">

$(function () {
    var status = parseInt('{{ status }}');
    var message = '{{ message }}';
    var jumpUrl = '{{ jumpUrl }}';
    var waitSecond = parseInt('{{ waitSecond }}') * 1000;
    var icon = status ? 6 : 5;

    layer.msg(message,{icon: icon});

    setInterval(function(){
        window.location.href = jumpUrl;
    }, waitSecond);
});

</script>