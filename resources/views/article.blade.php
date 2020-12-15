@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto relative">
        <h1>{{ $article->title }}</h1>

        <div class="font-medium my-8 text-center uppercase">
            @foreach($article->collections as $collection)
                <a class="mx-2 underline" href="#{{ $collection->slug }}">{{ $collection->title }}</a>
            @endforeach
        </div>

        <div class="max-w-4xl mx-auto my-8">
            <p class="font-medium my-8 text-center text-2xl">
                {{ $article->perex }}
            </p>

            {!! $article->content !!}
        </div>

        @foreach($article->collections as $collection)
            <h2 id="{{ $collection->slug }}">{{ $collection->title }}</h2>

            <div class="max-w-4xl mx-auto mb-8">
                {!! $collection->content !!}
            </div>

            <catalog-component category="{{ $collection->category }}"></catalog-component>
        @endforeach

        <div class="absolute left-full">
            <div class="bottom-8 fixed font-medium text-center underline uppercase">
                <a href="#">Nahoru</a><br>
                <a href="{{ route('homepage') }}">Menu</a>
            </div>
        </div>
    </div>
@endsection
