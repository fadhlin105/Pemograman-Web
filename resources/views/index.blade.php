@extends ('layouts.app')

@section('content')
    <div class="sm:grid grid-cols-2 gap-20 w-4/5 mx-auto py-15 border-b border-gray-200">
        <div>
            <img src="{{ asset('/img/sport.png') }}" width="700" alt="">
        </div>
        <div class="m-auto sm:m-auto text-left w-4/5 block">
            <h2 class="text-4xl font-extrabold text-gray-600">
                Selamat datang di Sporticle!
            </h2>
            <p class="py-8 text-gray-500 text-l">
                Platform pertama dan terbesar yang mengintegrasikan olahraga dengan teknologi yang dihimpun dengan data
                terkini dan terpercaya. Update info terbaru Setiap Detik!
            </p>
            <a href="/artikel" class="uppercase bg-blue-500 text-area-gray-100 text-s font-extrabold py-3 px-8 rounded-3xl">
                Selengkapnya
            </a>
        </div>
    </div>    
@endsection
