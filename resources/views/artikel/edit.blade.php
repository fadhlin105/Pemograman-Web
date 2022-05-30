@extends('layouts.app')
@section('content')
    <div class="py-5 w-4/5 m-auto text-left">
        <div class="border-b border-gray-200">
            <h1 class="text-3xl">
                Update Artikel
            </h1>
        </div>
    </div>
    @if ($errors->any())
        <div class="w-4/5 m-auto">
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="w-2/5 mb-3 text-gray-50 bg-red-700 rounded-2xl py-4 px-4">
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="w-4/5 m-auto">
        <form action="/artikel/{{ $post->slug }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="text" name="judul" value="{{ $post->judul }}" placeholder="Judul Artikel"
                class="py-3 px-2 bg-transparent block border-b-2 w-full h-20 test-6xl outline-none">
            <textarea name="deskripsi" placeholder="Isi Artikel"
                class="py-3 px-2 bg-transparent block border-b-2 w-full h-60 text-xl outline-none">{{ $post->deskripsi }}</textarea>
            <div class="bg -grey-lighter">
                <label
                    class="w-44 flex flex-col items-center px-2 py-3 bg-white-rounded-lg shadow-lg tracking-wide uppercase border-blue cursor-pointer">
                    <span class="mt-2 text-base leading-normal">
                        Upload Gambar
                    </span>
                    <input type="file" name="gambar" class="hidden">
                </label>
            </div>
            <button type="submit"
                class="uppercase mt-15 bg-blue-500 text-gray-100 text-lg font-extrabold py-4 px-8 rounded-3xl">
                Update Artikel
            </button>
        </form>
    </div>
@endsection
