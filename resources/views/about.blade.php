@extends('article')

@section('content')
    @parent

    <div class="max-w-4xl mx-auto -mt-28 mb-32 lg:mt-0 lg:mb-0">
        <h2 class="py-4 lg:py-8 underline">O výstavě</h2>

        <div class="mb-8 max-w-2xl mx-auto text-content text-center">
            <p>Autoři a kurátoři: Vilma Hubáčková, Barbora Vlášková, Bronislava Kuzica Rokytová, Jan Bouček, Jakub Hauser</p>
            <p>Layout a grafický design: Jaroslav Tvrdoň, lab.SNG</p>
            <p>Audiovizuální vzdělávací materiály: Kateřina Švejdová, Zuzana Dvorská Šípová, Jindřich Čížek, Petr Gal</p>
            <p>Propagace: Aneta Křižková</p>
            <p>Fotografie a skenování: Filip Beránek, Ondřej Přibyl, Miroslav Lisner, Viktor Vaniš, Radka Procházková</p>
            <p>Technická realizace: lab.SNG</p>
        </div>

        <h2 class="py-4 lg:py-8 underline">Pořadatelé</h2>

        <img class="max-w-lg mx-auto mb-4" src="/img/poradatele.svg">

        <h2 class="py-4 lg:py-8 underline">Partneři</h2>

        <img class="max-w-lg mx-auto mb-32" src="/img/partneri.svg">
    </div>
@endsection
