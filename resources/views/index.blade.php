<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>MSIB Forum</title>
</head>

<body>
    <div class="w-full flex justify-center gap-4 py-4 shadow-md">
        <a href="{{ route('login') }}" class="font-bold text-md text-blue-300 hover:text-blue-600">Login</a>
        <a href="{{ route('form_register') }}" class="font-bold text-md text-blue-300 hover:text-blue-600">Register</a>
    </div>
</body>

</html>
