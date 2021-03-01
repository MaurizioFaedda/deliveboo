<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield("page-title", "Deliveboo | Dashboard")</title>

        <!-- Scripts File JS-->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <!-- Scripts chart.js-->
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">

        <!-- Favicon -->
            <link rel="icon" href="{{ asset('img/favicon.png') }}">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body style="background-color: black;">
        <div class="moon"></div>
        <div class="moon__crater moon__crater1"></div>
        <div class="moon__crater moon__crater2"></div>
        <div class="moon__crater moon__crater3"></div>

        <div class="star star1"></div>
        <div class="star star2"></div>
        <div class="star star3"></div>
        <div class="star star4"></div>
        <div class="star star5"></div>

        <div class="error">
          <div class="error__title">404</div>
          <div class="error__subtitle">Hmmm...</div>
          <div class="text-dark error__description my-4 h4">You've just landed on the Moon,<br> just get back on Earth!</div>
          <a href="{{route('index')}}" class="error__button error__button--active p-2">Back to base</a>
        </div>

        <div class="astronaut">
          <div class="astronaut__backpack"></div>
          <div class="astronaut__body"></div>
          <div class="astronaut__body__chest"></div>
          <div class="astronaut__arm-left1"></div>
          <div class="astronaut__arm-left2"></div>
          <div class="astronaut__arm-right1"></div>
          <div class="astronaut__arm-right2"></div>
          <div class="astronaut__arm-thumb-left"></div>
          <div class="astronaut__arm-thumb-right"></div>
          <div class="astronaut__leg-left"></div>
          <div class="astronaut__leg-right"></div>
          <div class="astronaut__foot-left"></div>
          <div class="astronaut__foot-right"></div>
          <div class="astronaut__wrist-left"></div>
          <div class="astronaut__wrist-right"></div>

          <div class="astronaut__cord">
            <canvas id="cord" height="400px" width="400px"></canvas>
          </div>

          <div class="astronaut__head">
            <canvas id="visor" width="60px" height="60px"></canvas>
            <div class="astronaut__head-visor-flare1"></div>
            <div class="astronaut__head-visor-flare2"></div>
          </div>
        </div>
        <script type="text/javascript">
        function drawVisor() {
        const canvas = document.getElementById('visor');
        const ctx = canvas.getContext('2d');

        ctx.beginPath();
        ctx.moveTo(5, 45);
        ctx.bezierCurveTo(15, 64, 45, 64, 55, 45);

        ctx.lineTo(55, 20);
        ctx.bezierCurveTo(55, 15, 50, 10, 45, 10);

        ctx.lineTo(15, 10);

        ctx.bezierCurveTo(15, 10, 5, 10, 5, 20);
        ctx.lineTo(5, 45);

        ctx.fillStyle = '#2f3640';
        ctx.strokeStyle = '#f5f6fa';
        ctx.fill();
        ctx.stroke();
        }

        const cordCanvas = document.getElementById('cord');
        const ctx = cordCanvas.getContext('2d');

        let y1 = 160;
        let y2 = 100;
        let y3 = 100;

        let y1Forward = true;
        let y2Forward = false;
        let y3Forward = true;

        function animate() {
        requestAnimationFrame(animate);
        ctx.clearRect(0, 0, innerWidth, innerHeight);

        ctx.beginPath();
        ctx.moveTo(130, 170);
        ctx.bezierCurveTo(250, y1, 345, y2, 400, y3);

        ctx.strokeStyle = 'white';
        ctx.lineWidth = 8;
        ctx.stroke();


        if (y1 === 100) {
        y1Forward = true;
        }

        if (y1 === 300) {
        y1Forward = false;
        }

        if (y2 === 100) {
        y2Forward = true;
        }

        if (y2 === 310) {
        y2Forward = false;
        }

        if (y3 === 100) {
        y3Forward = true;
        }

        if (y3 === 317) {
        y3Forward = false;
        }

        y1Forward ? y1 += 1 : y1 -= 1;
        y2Forward ? y2 += 1 : y2 -= 1;
        y3Forward ? y3 += 1 : y3 -= 1;
        }

        drawVisor();
        animate();
        </script>
    </body>
</html>
