@extends('layouts.app')

@section('content')
    <div class="bg-cover border-2 md:border-4 border-black relative" style="padding-bottom: 29.72%; background-image: url('../img/background.jpg');">
        <h1 class="absolute left-1/2 top-1/2 transform -translate-x-1/2 -translate-y-1/2 whitespace-nowrap" style="font-size: 6vw;">Virtuální galerie Jiřího Karáska ze Lvovic</h1>
    </div>

    <div class="md:border-0.5 border-black md:mt-10 p-5 text-center">
        <div class="max-w-6xl mx-auto">
            @foreach($menu as $slug => $title)
                <a class="block md:inline-block font-medium leading-normal my-4 md:mx-2 md:my-1 underline hover:no-underline uppercase" href="{{ route('article', ['article' => $slug]) }}">{{ $title }}</a>
            @endforeach
            <a class="block md:inline-block font-medium leading-normal my-4 md:mx-2 md:my-1 underline hover:no-underline uppercase" href="{{ route('catalog') }}">Katalog</a>
        </div>
    </div>
@endsection
