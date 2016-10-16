<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="{{ asset('assets/admin/js/libs/jquery/jquery-1.11.2.min.js') }}"></script>
    <title>Document</title>
</head>
<body>

<div id="mydiv">
    {{--<img src="/img/logo-white.png" />--}}
    <p>text nafggggghsghsdfsfgsdg<br>adfadfadfafdsdafadi !</p>
</div>
<br>
<br>

<div id="canvas">
    <p>Canvas:</p>
</div>

<div id="image">
    <p>Image:</p>
</div>
<input type="hidden" id="url" value="{{ $url }}">
<script src="http://html2canvas.hertzen.com/build/html2canvas.js"></script>

<script>
    html2canvas([document.getElementById('mydiv')], {
        onrendered: function (canvas) {
            document.getElementById('canvas').appendChild(canvas);
            var data = canvas.toDataURL('image/png');
            // AJAX call to send `data` to a PHP file that creates an image from the dataURI string and saves it to a directory on the server



            var theUrl = $('#url').val();
            window.location.href = theUrl + '?ticket='+data;
            var image = new Image();
            image.src = data;
            document.getElementById('image').appendChild(image);
        }
    });
</script>
</body>
</html>