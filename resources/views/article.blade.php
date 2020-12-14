@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto relative">
        <h1>{{ $article->title }}</h1>

        <div class="font-medium my-8 text-center underline uppercase">
            @foreach($article->children as $child)
                <a href="#{{ $child->slug }}">{{ $child->title }}</a>
            @endforeach
        </div>

        <div class="max-w-4xl mx-auto">
            <p class="font-medium my-8 text-center text-xl">
                {{ $article->perex }}
            </p>

            <p class="my-8">
                {!! $article->content !!}
            </p>
        </div>

        @foreach($article->children as $child)
            <h2 id="{{ $child->slug }}">{{ $child->title }}</h2>

            <div class="max-w-4xl mx-auto">
                <p class="font-medium my-8 text-center text-xl">
                    {{ $child->perex }}
                </p>

                <p class="my-8">
                    {!! $child->content !!}
                </p>
            </div>

            <catalog-component category="{{ $child->category }}"></catalog-component>
        @endforeach

        <div class="absolute left-full">
            <div class="bottom-8 fixed font-medium text-center underline uppercase">
                <a href="#">Nahoru</a><br>
                <a href="#">Menu</a>
            </div>
        </div>
    </div>
@endsection
