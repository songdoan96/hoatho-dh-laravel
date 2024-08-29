<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chào mừng</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .text-marquee {
            animation: marquee linear infinite;
        }

        @keyframes marquee {
            0% {
                transform: translateX(0%);
            }

            100% {
                transform: translateX(-100%);
            }
        }
    </style>
</head>

<body scroll="no" style="overflow: hidden;">
    <article
        class="bg-[#0163C6] text-[#ededed] text-lg font-black md:text-3xl overflow-hidden whitespace-nowrap w-screen flex">
        <ul class="text-marquee"
            style="display: flex;padding: 0;animation-duration: <?= count($schedules) * 20 . 's' ?>">
            @foreach ($schedules as $schedule)
                <li class="md:py-1 ml-[calc(100vw/3)] list-disc">
                    {{ formatDate($schedule->date, 'd-m-Y') }}: {{ $schedule->content }}
                </li>
            @endforeach
        </ul>
    </article>
    @if (count($images))
        <img id="image-show" class="w-full h-auto bg-cover object-cover" />
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
