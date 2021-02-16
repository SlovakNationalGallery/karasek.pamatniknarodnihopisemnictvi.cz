@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto relative mb-32 lg:mb-0">
        <h1>Katalog výstavy</h1>

        <div class="max-w-4xl mx-auto my-4 lg:my-8">
            <p class="font-medium my-4 lg:my-8 text-center text-xl lg:text-2xl">
                Katalog výstavy představuje místo, na kterém divák Virtuální
                galerie Jiřího Karáska ze Lvovic nalezne všechna dosud digitálně
                zpracovaná díla Karáskovy sbírky a kde mezi nimi může procházet
                jak na základě jejich autorů, námětů, tak podle data jejich vzniku.
            </p>
        </div>

        <catalog-component></catalog-component>

        <menu-component :catalog="false"></menu-component>
    </div>
@endsection
