@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto relative mb-32 lg:mb-0">
        <h1>Katalog výstavy</h1>

        <div class="max-w-4xl mx-auto my-4 lg:my-8">
            <p class="font-medium my-4 lg:my-8 text-center text-xl lg:text-2xl">
                <span class="font-italic">Katalog výstavy</span> představuje místo, na kterém divák Virtuální
                galerie Jiřího Karáska ze Lvovic nalezne všechna dosud digitálně
                zpracovaná díla Karáskovy sbírky a kde mezi nimi může procházet
                jak na základě jejich názvů, námětů, tak podle data jejich vzniku.
            </p>
        </div>

        <catalog-component></catalog-component>

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
