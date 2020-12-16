@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto relative mb-32 lg:mb-0">
        <h1>{{ $article->title }}</h1>

        <div class="font-medium my-4 lg:my-8 text-center uppercase">
            @foreach($article->collections as $collection)
                <a class="mx-2 underline" href="#{{ $collection->slug }}">{{ $collection->title }}</a>
            @endforeach
        </div>

        <div class="max-w-4xl mx-auto my-4 lg:my-8">
            <p class="font-medium my-4 lg:my-8 text-center text-xl lg:text-2xl">
                {{ $article->perex }}
            </p>

            {!! $article->content !!}
        </div>

        @foreach($article->collections as $collection)
            <h2 class="py-4 lg:py-8 underline" id="{{ $collection->slug }}">{{ $collection->title }}</h2>

            <div class="max-w-4xl mx-auto mb-5 lg:mb-10">
                {!! $collection->content !!}
            </div>

            <catalog-component category="{{ $collection->category }}"></catalog-component>
        @endforeach

        <div class="flex items-center justify-center lg:block bg-white lg:bg-none border-black border-t-0.5 lg:border-0 fixed lg:static bottom-0 left-5 right-5">
            <div class="lg:absolute left-full">
                <div class="bottom-0 lg:fixed font-medium leading-loose p-4 lg:p-8 text-center underline uppercase">
                    <a href="#">Nahoru</a><br>
                    <a href="/">Menu</a>
                </div>
            </div>
        </div>
    </div>
@endsection
