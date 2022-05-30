@extends('layouts.app')
@section('content')
    <div class="w-4/5 m-auto text-left">
        <div class="py-5 border b border-gray-200">
            <h1 class="text-3xl">
                Artikel Tersimpan
            </h1>
        </div>
    </div>
    @if (session()->has('message'))
        <div class="w-4.5 m-auto mt-10 pl-2">
            <p class="w-2/6 mb-4 text-gray-50 bg-green-500 roundel-2xl py-4">
                {{ session()->get('message') }}
            </p>
        </div>
    @endif
    @if (Auth::check())
        <div class="py-5 w-4/5 m-auto">
            <a href="/artikel/create"
                class="bg-blue-500 uppercase bg-transparent text-gray-100 text-xs font-extrabold py-3 px-5 rounded-3xl">
                Tambah Artikel
            </a>
        </div>
    @endif

    @foreach ($post as $post)
        <div class="sm:grid grid-cols-2 gap-20 w-4/5 mx-auto py-15 border-b border-gray-200">
            <div>
                <img src="{{asset('img/' . $post->image_path )}}" width="700" alt="">
            </div>
            <div>
                <h2 class="text-gray-700 font-bold text-5xl pb-4">
                    {{ $post->judul }}
                </h2>
                <span class="text-area-gray">Ditulis oleh <span
                        class="font-bold italic text-gray-800">{{ $post->user->name }}</span>,
                    {{ date('jS M Y', strtotime($post->updated_at)) }}</span>
                <p class="text-xl text-gray-700 pt-8 pb-10 leading-8 font-light">
                    {{ $post->deskripsi }}
                </p>
                <a href="/artikel/{{ $post->slug }}"
                    class="uppercase bg-blue-500 text-gray-100 text-l font-extrabold py-4 px-8 rounded-3xl">Lanjutkan</a>
                @if (isset(Auth::user()->id) && Auth::user()->id == $post->user_id)
                    <span class="float-right">
                        <form action="/artikel/{{ $post->slug }}" method="POST">
                            @csrf
                            @method('delete')
                            <button class="text-red-500 pr-3" type="submit">
                                Hapus
                            </button>
                        </form>
                    </span>
                    <span class="float-right">
                        <a href="/artikel/{{ $post->slug }}/edit"
                            class="text-gray-700 italic hover:text-gray-900 pb-1 border-b-2">
                            Edit
                        </a>
                    </span>
                @endif
            </div>
        </div>
    @endforeach
@endsection
