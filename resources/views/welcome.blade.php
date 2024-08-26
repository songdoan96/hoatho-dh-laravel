<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chào mừng</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body scroll="no" style="overflow: hidden">
    @if (count($images))
        <img id="image-show" width="100%" height="100%" />
    @else
        <img src="{{ asset('images/logo2.png') }}" id="image-show" width="100%" height="100%" />
    @endif
    <script>
        var currentIndex = 0;
        const images = {!! json_encode($images->toArray()) !!};

        function changeImage() {
            if (currentIndex >= images.length) {
                currentIndex = 0;
            }
            document.getElementById('image-show').src = "{{ asset('storage') }}/" + images[currentIndex].path;
            currentIndex++;
            setTimeout(changeImage, 60000);
        }
        changeImage();
    </script>
</body>

</html>
