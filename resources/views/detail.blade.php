@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto">
        <div class="lg:flex lg:-mx-8 -my-8 lg:my-0 relative">

            <div class="absolute right-full">
                <a class="fixed text-6xl top-1/2 transform -translate-x-full -translate-y-1/2" href="#">&larr;</a>
            </div>

            <div class="absolute left-full">
                <a class="fixed text-6xl top-1/2 transform -translate-y-1/2" href="#">&rarr;</a>

                <div class="bottom-8 fixed font-medium text-center underline uppercase">
                    <a href="#">Nahoru</a><br>
                    <a href="#">Menu</a>
                </div>
            </div>

            <div class="my-8 lg:my-0 lg:mx-8 lg:w-1/2">
                <img class="mx-auto" src="https://via.placeholder.com/600x800">
            </div>
            <div class="my-8 lg:my-0 lg:w-1/2 lg:mx-8">
                <hr class="border-t-0.5 border-black">

                <h2 class="my-3 leading-tight text-2xl no-underline">William Hogarth (1697—1764)</h2>

                <hr class="border-t-0.5 border-black">

                <p class="my-3 text-center">
                    <strong class="uppercase">Pět typů paruk</strong><br>
                    Datace: 1761<br>
                    Rozměry: 297 × 215 mm<br>
                    Výtvarný druh: Grafika<br>
                    Námět: Kostým<br>
                    Materiál: Papír<br>
                    Technika: Lept<br>
                    Inventární číslo: IG 7823<br>
                    Značení: W. Hogart
                </p>

                <hr class="border-t-0.5 border-black">

                <p class="my-3">
                    Sarkastickým grafickým znázorněním pěti paruk William Hogarth
                    paroduje společenské dění v Anglii v druhé polovině 18. století.
                    Zejména reaguje na dlouho zamýšlenou publikaci Jamese Stuarta
                    a Nicolase Revetta „Athénské antické památky”, která měla vyjít
                    již po roce 1748. První díl však vychází až rok po uveřejnění
                    této grafiky a další dva díly byly vydány v odstupu téměř
                    třiceti let od původního plánu. V popisku Hoghart přirovnává
                    Stuartův ctižádostivý projekt k Lagadské akademii ze Swiftových
                    Guliverových cest, která též neplnila žádoucí výsledky. Zároveň
                    se Hogarth vysmívá mechanickým kánonům krásy, odvozeným ze
                    slepého přeměřování antických památek. Šestice řad vymezuje
                    společenské postavení, které umělec ironicky přirovnává k pěti
                    antickým architektonickým slohům definovaným Palládiem. První
                    skupina náleží biskupům, následuje aristokracie, panovník, čtvrtá
                    patří kompozitnímu slohu, elegánům a poslední ženám. Do obrazu
                    jsou zasazeny i konkrétní tváře. V horní části zobrazuje dva biskupy
                    Williama Warburtona a Samuela Squira. V druhé řadě po levé
                    straně nalezneme podobiznu lorda Malcomba a na pravé straně
                    je vypodobněna paruka londýnského starosty Samuela Fludyera.
                    William Hogarth se tak explicitně vysmívá rostoucí formalizaci
                    paruk, které se stávají vyprázdněnými symboly.
                </p>
            </div>
        </div>
    </div>
@endsection
