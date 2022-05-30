@extends('layouts.app')
@section('content')
    <div class="py-5 w-4/5 m-auto text-left">
        <div class="border-b border-gray-200">
            <h1 class="text-3xl">
               {{$post->judul}}
            </h1>
        </div>
    </div>    
    <div class="w-4/5 m-auto">
        <span class="text-gray-500">
            By <span class="font-bold italic text-gray-800">{{$post->user->name}}</span>, {{date('jS M Y', strtotime($post->updated_at))}}</span>
        </span>
        <p class="text-xl text-gray-700 pt-8 pb-10 leading-8 font-light">
            {{$post->deskripsi}}
        </p>
    </div>
@endsection
