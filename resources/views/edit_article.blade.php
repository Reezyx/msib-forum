<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <title>MSIB Forum</title>
</head>

<body>
    <div class="w-full h-screen flex">
        <div class="my-auto mx-auto w-1/3">
            <div class="bg-gray-300 border-solid border-2 border-gray-800 rounded-md px-3 py-3">
                <div class="flex justify-between">
                    <p class="text-lg font-bold my-2">Buat Artikel</p>
                    <a class="my-auto text-blue-400 hover:text-blue-800" href="{{ route('article') }}">
                        < Kembali</a>
                </div>
                <form action="{{ route('update_article', ['article' => $article->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="my-2">
                        <label for="category">Category</label>
                        <select class="form-select" id="category" aria-label="Default select example" name="category">
                            <option value="1" {{ $article->category->id == 1 ? 'selected' : '' }}>Teknologi
                            </option>
                            <option value="2" {{ $article->category->id == 2 ? 'selected' : '' }}>Kesehatan
                            </option>
                            <option value="3" {{ $article->category->id == 3 ? 'selected' : '' }}>Edukasi</option>
                            <option value="4" {{ $article->category->id == 4 ? 'selected' : '' }}>Gaya Hidup
                            </option>
                            <option value="5" {{ $article->category->id == 5 ? 'selected' : '' }}>Politik</option>
                            <option value="6" {{ $article->category->id == 6 ? 'selected' : '' }}>Hobi</option>
                            <option value="7" {{ $article->category->id == 7 ? 'selected' : '' }}>Entertainment
                            </option>
                        </select>
                    </div>
                    <div class="my-2">
                        <label for="exampleFormControlTextarea1" class="form-label">Tuliskan Pesanmu!</label>
                        <textarea class="form-control" name="article" id="exampleFormControlTextarea1" rows="5">{{ $article->article }}</textarea>
                    </div>
                    <div class="w-1/3 flex mx-auto">
                        <button type="submit" class=" btn btn-outline-primary w-full mt-2">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
