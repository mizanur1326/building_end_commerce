<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.9.0/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/74bd3f5679.js" crossorigin="anonymous"></script>
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('./assets/frontend/style.css') }}"> 
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Aclonica&family=Alata&family=Satisfy&display=swap"
        rel="stylesheet" />
    <title>My Ecommerce Project HTML</title>
</head>

<body class="alata">
    @include('frontend.partials.header')

    
    <main>
        @yield('home')        
    </main>

    @include('frontend.partials.footer')
</body>

</html>