<template>
    <div class="flex items-center lg:block bg-white lg:bg-none border-black border-t-0.5 lg:border-0 fixed lg:static bottom-0 left-5 right-5 py-4">
        <div class="lg:absolute right-full lg:p-8" v-if="previous">
            <a class="lg:fixed leading-none text-4xl lg:text-6xl top-1/2 transform -translate-x-full -translate-y-1/2" :href="previous">&larr;</a>
        </div>

        <div class="lg:absolute flex-grow lg:left-full lg:p-8">
            <div class="bottom-8 lg:fixed flex flex-wrap lg:flex-col font-medium justify-center leading-loose text-center uppercase">
                <a class="underline px-3" :href="back" v-if="back">Zpět</a>
                <a class="underline px-3" href="#" v-else-if="top">Nahoru</a>
                <a class="underline px-3" href="/">Menu</a>
                <a class="underline px-3" href="/katalog" v-if="catalog">Katalog</a>
            </div>
        </div>

        <div class="lg:absolute left-full lg:p-8" v-if="next">
            <a class="lg:fixed leading-none text-4xl lg:text-6xl top-1/2 transform -translate-y-1/2" :href="next">&rarr;</a>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        back: {
            type: String
        },
        previous: {
            type: String
        },
        next: {
            type: String
        },
        top: {
            type: Boolean,
            default: true,
        },
        catalog: {
            type: Boolean,
            default: true,
        }
    }

}
</script>
