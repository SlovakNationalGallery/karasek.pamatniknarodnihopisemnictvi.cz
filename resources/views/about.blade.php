@extends('article')

@section('content')
    @parent

    <div class="max-w-4xl mx-auto -mt-28 mb-32 lg:mt-0 lg:mb-0">
        <figure class="my-12">
            <img src="https://via.placeholder.com/1280x720">
            <figcaption class="font-medium my-4 text-center">WILLIAM HOGARTH, Pět typů paruk, 1761</figcaption>
        </figure>

        <h2 class="py-4 lg:py-8 underline">O výstavě</h2>

        <p class="text-center">
            Autoři a kurátoři: Barbora Vlášková, Jan Bouček<br>
            Odborný poradce: Vilma Hubáčková<br>
            Layout a grafický design: Jaroslav Tvrdoň, lab.SNG<br>
            Audiovizuální vzdělávací materiály: Kateřina Švejdová, Zuzana Dvorská Šípová,<br>
            Marie Píchová, Jindřich Čížek, Petr Gal<br>
            Propagace: Aneta Křižková<br>
            Fotografie a skenování: Filip Beránek, Miroslav Lisner<br>
            Technická realizace: lab.SNG
        </p>

        <h2 class="py-4 lg:py-8 underline">Pořadatelé</h2>

        <img class="max-w-lg mx-auto" src="/img/poradatele.svg">

        <h2 class="py-4 lg:py-8 underline">Partneři</h2>

        <img class="max-w-lg mx-auto mb-32" src="/img/partneri.svg">
    </div>
@endsection
