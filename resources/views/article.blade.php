<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>MSIB Forum</title>
</head>

<body class="w-full">
    <div class="flex justify-between gap-4 py-4 px-4 shadow-md">
        <div>
            <a href="{{ route('form_article') }}" class="font-bold text-md text-blue-300 hover:text-blue-600">Buat
                Artikel</a>
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            @method('POST')
            <button type="submit" class="font-bold text-md text-blue-300 hover:text-blue-600">Logout</button>
        </form>
    </div>
    <div class="my-2 mx-3">
        @foreach ($articles as $article)
            <div class="w-full bg-gray-200 shadow-md py-3 px-3 my-3 rounded-md">
                <div class="flex justify-between">
                    <div class="flex gap-2">
                        <img class="rounded-full w-8" src="{{ $article->user->image }}" alt="">
                        <p class="font-semibold my-auto">{{ $article->user->name }}</p>
                        <div class="bg-blue-500 rounded-full flex px-2">
                            <p class="text-sm my-auto font-bold text-white">{{ $article->category->name }}</p>
                        </div>
                    </div>
                    <div class="my-auto flex gap-3">
                        <a href="{{ route('see_article', ['article' => $article->id]) }}"
                            class="text-gray-500 hover:text-gray-800"><i class="fa fa-eye"></i></a>
                        @if ($article->is_mine)
                            <a href="{{ route('edit_article', ['article' => $article->id]) }}"
                                class="text-gray-500 hover:text-gray-800"><i class="fa fa-edit"></i></a>
                            <button data-href="{{ route('delete_article', ['article' => $article->id]) }}"
                                class="text-red-500 hover:text-red-800 btn-delete"><i class="fa fa-trash"></i></button>
                        @endif
                    </div>
                </div>
                <p class="my-3">{{ $article->article }}</p>
                <div class="flex justify-end">
                    <p class="font-semibold text-sm text-gray-500">{{ $article->total_likes }} Likes</p>
                </div>
            </div>
        @endforeach
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $('.btn-delete').on('click', function(e) {
        e.preventDefault();
        let url = $(this).data('href');
        console.log(url);
        if (confirm(
                'Apakah Anda yakin ingin menghapus article ini? Data yang telah dihapus tidak dapat dikembalikan'
            )) {
            $.ajax({
                type: 'post',
                url: url,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                dataType: 'json',
            }).done(function(data) {
                if (data.code == 200) {
                    alert(data.info);
                    location.reload();
                } else {
                    alert(data.info);
                    location.reload();
                }
            }).fail(function(data) {
                alert(data.info);
                location.reload();
            });
        }
    });
</script>

</html>
