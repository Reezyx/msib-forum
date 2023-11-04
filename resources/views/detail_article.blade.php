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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <title>MSIB Forum</title>
</head>

<body class="w-full">
    <div class="flex justify-between gap-4 py-4 px-4 shadow-md">
        <div>
            <a href="{{ route('article') }}" class="font-bold text-md text-blue-300 hover:text-blue-600">
                < Kembali</a>
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            @method('POST')
            <button type="submit" class="font-bold text-md text-blue-300 hover:text-blue-600">Logout</button>
        </form>
    </div>
    <div class="my-2 mx-3">
        <div class="w-full bg-gray-200 shadow-md py-3 px-3 my-3 rounded-md">
            <div class="flex justify-between">
                <div class="flex gap-2">
                    <img class="rounded-full w-8" src="{{ $article->user->image }}" alt="">
                    <p class="font-semibold my-auto">{{ $article->user->name }}</p>
                    <div class="bg-blue-500 rounded-full flex px-2">
                        <p class="text-sm my-auto font-bold text-white">{{ $article->category->name }}</p>
                    </div>
                </div>
            </div>
            <div class="flex justify-between">
                <p class="my-1">{{ $article->article }}</p>
                <button data-href="{{ route('like_article', ['article' => $article->id]) }}"
                    class="{{ $article->is_like ? 'text-red-600' : 'text-gray-500' }} btn-like"><i class="fa fa-heart"
                        style="font-size: 24px"></i></button>
            </div>
        </div>

        <form action="{{ route('comment_article', ['article' => $article->id]) }}" method="POST">
            @csrf
            @method('POST')
            <div class="my-2 flex gap-2">
                <textarea class="form-control" name="comment" id="exampleFormControlTextarea1" rows="1"
                    placeholder="Tuliskan pesanmu..."></textarea>
                <div class="flex">
                    <button class="btn btn-outline-dark my-auto">Kirim</button>
                </div>
            </div>
        </form>

        <div>
            <p class="text-blue-400 font-semibold">Komentar Temanmu</p>
            <div class="border-solid border-t-2 border-gray-300 rounded-full mt-2"></div>
            @foreach ($article->comment as $comment)
                <div class="w-full bg-gray-200 shadow-md py-3 px-3 my-3 rounded-md">
                    <div class="flex justify-between">
                        <div class="flex gap-2">
                            <img class="rounded-full w-8" src="{{ $comment->user->image }}" alt="">
                            <p class="font-semibold my-auto">{{ $comment->user->name }}</p>
                        </div>
                    </div>
                    <div class="flex justify-between">
                        <p class="my-1">{{ $comment->comment }}</p>
                        <button
                            data-href="{{ route('like_comment', ['article' => $article->id, 'comment' => $comment->id]) }}"
                            class="{{ $comment->is_like ? 'text-red-600' : 'text-gray-500' }} btn-like"><i
                                class="fa fa-heart" style="font-size: 24px"></i></button>
                    </div>
                    <div class="flex justify-end">
                        <p class="font-semibold text-sm text-gray-500">{{ $comment->total_likes }} Likes</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $('.btn-like').on('click', function(e) {
        e.preventDefault();
        let url = $(this).data('href');
        console.log(url);
        $.ajax({
            type: 'post',
            url: url,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            dataType: 'json',
        }).done(function(data) {
            if (data.code == 200) {
                location.reload();
            } else {
                location.reload();
            }
        }).fail(function(data) {
            location.reload();
        });
    })
</script>

</html>
