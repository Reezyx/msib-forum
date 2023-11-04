<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script script script src="https://cdn.tailwindcss.com"></script>
    <title>Register | MSIB Forum</title>
</head>

<body>
    <div class="w-full flex justify-end">
        <div class="w-1/2 bg-gray-200 h-screen px-5 flex">
            <form action="{{ route('send_register') }}" method="POST" class="my-auto">
                @if (Session::has('error'))
                    <div class="bg-red-300 px-2 py-2 rounded-sm border-solid border-2 border-red-500">
                        <p>{{ Session::get('error') }}</p>
                    </div>
                @elseif (Session::has('success'))
                    <div class="bg-green-300 px-2 py-2 rounded-sm border-solid border-2 border-green-500">
                        <p>{{ Session::get('success') }}</p>
                    </div>
                @endif
                @csrf
                @method('POST')
                <div class="">
                    <label for="exampleFormControlInput1" class="form-label">Foto Profile</label>
                    <input type="text" name="image" class="form-control" id="exampleFormControlInput1"
                        placeholder="Link Foto Profile">
                </div>
                <div class="mt-2">
                    <label for="exampleFormControlInput1" class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" id="exampleFormControlInput1"
                        placeholder="Nama Lengkap">
                </div>
                <div class="mt-2">
                    <label for="exampleFormControlInput1" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" id="exampleFormControlInput1"
                        placeholder="Username">
                </div>
                <div class="mt-2">
                    <label for="exampleFormControlInput1" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="exampleFormControlInput1"
                        placeholder="Alamat Email">
                </div>
                <div class="mt-2">
                    <label for="inputPassword5" class="form-label">Password</label>
                    <input type="password" id="inputPassword5" name="password" class="form-control"
                        aria-describedby="passwordHelpBlock" placeholder="Password">
                    <div id="passwordHelpBlock" class="form-text text-gray-500">
                        Your password must be 8-20 characters long, contain letters and numbers, and must not
                        contain
                        spaces,
                        special characters, or emoji.
                    </div>
                </div>
                <div class="flex">
                    <button class="btn btn-outline-primary mt-3 w-1/3 mx-auto">Signup</button>
                </div>
                <p class="text-center text-md font-semibold mt-2">Sudah punya akun? <a
                        class="text-blue-500 hover:text-blue-800" href="{{ route('login') }}">Yuk Masuk</a></p>
            </form>
        </div>
    </div>
</body>

</html>
