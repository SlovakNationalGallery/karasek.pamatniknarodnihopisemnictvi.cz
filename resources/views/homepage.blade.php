@extends('layouts.app', ['bodyClasses' => 'bg-cover bg-texture'])

@section('content')
    <div class="max-w-6xl mx-auto">
        <h1>Virtuální galerie Jiřího Karáska ze Lvovic</h1>

        <div class="my-12 relative">
            <ol class="flex flex-col flex-wrap items-center list-decimal list-inside lg:h-168 relative lg:content-between lg:justify-evenly">
                @foreach($articles as $article)
                    <li class="bg-white m-8 max-w-sm p-4 relative text-center">
                        <a href="{{ route('article', ['article' => $article]) }}">{{ $article->title }}</a>
                        <a class="absolute inset-0" href="{{ route('article', ['article' => $article]) }}"></a>
                    </li>
                @endforeach
            </ol>

            <div class="absolute left-1/2 mx-auto top-0 transform -translate-x-1/2 w-128 hidden lg:block">
                <img class="border-2 md:border-4 border-black" src="/img/karasek.jpg" alt="Jiří Karásek">
            </div>
        </div>
    </div>
@endsection
