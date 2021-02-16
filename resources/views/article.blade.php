@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto relative mb-32 lg:mb-0">
        <h1>{{ $article->title }}</h1>

        <div class="font-medium my-4 lg:my-8 text-center uppercase">
            @foreach($article->collections as $collection)
                <a class="mx-2 underline hover:no-underline whitespace-nowrap" href="#{{ $collection->slug }}">{{ $collection->title }}</a>
            @endforeach
        </div>

        <div class="max-w-4xl mx-auto my-4 lg:my-8">
            <p class="font-medium my-4 lg:my-8 text-center text-xl lg:text-2xl">
                {{ $article->perex }}
            </p>

            <div class="text-content">
                {!! $article->content !!}
            </div>
        </div>

        @if($article->set)
            <grid-component :filter='@json(['additionals.set.keyword' => $article->set])'></grid-component>
        @endif

        @foreach($article->collections as $collection)
            <h2 class="py-4 lg:py-8 underline" id="{{ $collection->slug }}">{{ $collection->title }}</h2>

            <div class="text-content max-w-4xl mx-auto mb-5 lg:mb-10">
                {!! $collection->content !!}
            </div>

            @if($collection->category)
                <grid-component :per-page="6" :filter='@json(['additionals.category.keyword' => $collection->category])'></grid-component>
            @endif
        @endforeach

        <menu-component></menu-component>
    </div>
@endsection
