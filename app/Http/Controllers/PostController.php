<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Cviebrock\EloquentSluggable\Services\SlugService;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except'=>['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('artikel.index')
            ->with('post', Post::orderBy('updated_at', 'DESC')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('artikel.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required|mimes:jpg,png,jpeg|max:5048'
        ]);
        $newImageName = uniqid() . '-' . $request->judul . '.' . $request->gambar->extension();
        $request->gambar->move(public_path('img'), $newImageName);
        $slug = SlugService::createSlug(Post::class, 'slug', $request->judul);
        Post::create([
            'judul' => $request->input('judul'),
            'deskripsi' => $request->input('deskripsi'),
            'slug' => SlugService::createSlug(Post::class, 'slug', $request->judul),
            'image_path' => $newImageName,
            'user_id' => auth()->user()->id
        ]);
        return redirect('/artikel')->with('message', 'Artikel berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        return view('artikel.show')->with('post', Post::where('slug', $slug)->first());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        return view('artikel.edit')->with('post', Post::where('slug', $slug)->first());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        Post::where('slug', $slug)
            ->update([
                'judul' => $request->input('judul'),
                'deskripsi' => $request->input('deskripsi'),
                'slug' => SlugService::createSlug(Post::class, 'slug', $request->judul),
                'user_id' => auth()->user()->id
            ]);
        return redirect('/artikel')->with('message', 'Artikel Berhasil Diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $post = Post::where('slug', $slug);
        $post->delete();

        return redirect('/artikel')->with('message', 'Artikel Berhasil Dihapus!');
    }
}
