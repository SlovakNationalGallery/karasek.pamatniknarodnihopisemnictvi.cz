<template>
    <div v-if="item">
        <div class="max-w-6xl mx-auto mb-32 lg:mb-0">
            <div class="lg:flex lg:-mx-8 -my-8 lg:my-0 relative">
                <div class="my-8 lg:my-0 lg:mx-8 relative lg:w-1/2">
                    <a :href="getZoomUrl(item)" class="group">
                        <span class="absolute bg-black leading-none right-5 opacity-60 group-hover:opacity-100 p-2 rounded-full top-5 z-10">
                            <i class="fa fa-search-plus text-white"></i>
                        </span>
                        <img class="mx-auto" :src="getImage(item, 800)">
                    </a>
                </div>
                <div class="my-8 lg:my-0 lg:w-1/2 lg:mx-8">
                    <hr class="border-black border-t-0.5">

                    <h2 class="leading-tight py-4 text-xl lg:text-2xl">
                        <a class="hover:underline" :href="`/katalog#/?filter[author]=${encodeURIComponent(item.document.content.author[0])}`">{{ formatName(item.document.content.author[0]) }}</a>
                        <span class="whitespace-nowrap" v-if="item.document.content.additionals.author_birth_year || item.document.content.additionals.author_death_year">
                            ({{ item.document.content.additionals.author_birth_year }}—{{ item.document.content.additionals.author_death_year}})
                        </span>
                    </h2>

                    <hr class="border-black border-t-0.5">

                    <p class="my-3 text-center">
                        <strong class="uppercase">{{ item.document.content.title }}</strong><br>
                        <template v-if="item.document.content.dating">
                            Datace: {{ item.document.content.dating }}<br>
                        </template>
                        <template v-if="item.document.content.measurement">
                            Rozměry: {{ item.document.content.measurement.join(', ') }}<br>
                        </template>
                        <template v-if="item.document.content.work_type">
                            Výtvarný druh: {{ item.document.content.work_type }}<br>
                        </template>
                        <template v-if="item.document.content.topic">
                            Námět:
                            <template v-for="(topic, index) in item.document.content.topic">
                                <a class="hover:underline" :href="`/katalog#/?filter[topic]=${encodeURIComponent(topic)}`">{{ topic }}</a>
                                <template v-if="index + 1 < item.document.content.topic.length">,</template>
                            </template><br>
                        </template>
                        <template v-if="item.document.content.medium">
                            Materiál: {{ item.document.content.medium }}<br>
                        </template>
                        <template v-if="item.document.content.technique">
                            Technika: {{ item.document.content.technique.join(', ') }}<br>
                        </template>
                        <template v-if="item.document.content.identifier">
                            Inventární číslo: {{ item.document.content.identifier }}<br>
                        </template>
                        <template v-if="item.document.content.inscription">
                            Značení: {{ item.document.content.inscription }}
                        </template>
                    </p>

                    <hr class="border-t-0.5 border-black">

                    <p class="my-3 whitespace-pre-line">{{ item.document.content.description.trim() }}</p>
                </div>

                <div class="flex items-center justify-between lg:block bg-white lg:bg-none border-black border-t-0.5 lg:border-0 fixed lg:static bottom-0 left-5 right-5">
                    <div class="lg:absolute right-full p-4 lg:p-8">
                        <a class="lg:fixed leading-none text-6xl top-1/2 transform -translate-x-full -translate-y-1/2" :href="previous" v-if="previous">&larr;</a>
                    </div>

                    <div class="lg:absolute left-full p-4 lg:p-8">
                        <div class="bottom-8 lg:fixed font-medium leading-loose text-center underline uppercase">
                            <a :href="back" v-if="back">Zpět</a><br>
                            <a href="/">Menu</a>
                        </div>
                    </div>

                    <div class="lg:absolute left-full p-4 lg:p-8">
                        <a class="lg:fixed leading-none text-6xl top-1/2 transform -translate-y-1/2" :href="next" v-if="next">&rarr;</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { apiMixin } from '../mixins';

export default {
    mixins: [apiMixin],

    data() {
        return {
            item: null,
            previous: null,
            next: null,
            back: null,
        };
    },

    props: ['id'],

    created() {
        this.fetchItem(this.id)
            .then(({data}) => {
                this.item = data;
                const order = this.item.document.content.additionals.order;
                const set = this.item.document.content.additionals.set;
                const category = this.item.document.content.additionals.category;

                const params = this.createParams();
                if (category) {
                    params.append('filter[additionals.category.keyword]', category);
                } else {
                    params.append('filter[additionals.set.keyword]', set);
                }

                const prevParams = new URLSearchParams(params);
                prevParams.append('filter[additionals.order][lt]', order);
                prevParams.append('sort[additionals.order]', 'desc');
                this.fetchItems(prevParams)
                    .then(({data}) => {
                        if (data.data[0]) {
                            this.previous = this.getDetailUrl(data.data[0]);

                            window.addEventListener('keydown', e => {
                                if (e.which === 37) {
                                    window.location = this.previous;
                                }
                            });
                        }
                    });

                const nextParams = new URLSearchParams(params);
                nextParams.append('filter[additionals.order][gt]', order);
                nextParams.append('sort[additionals.order]', 'asc');
                this.fetchItems(nextParams)
                    .then(({data}) => {
                        if (data.data[0]) {
                            this.next = this.getDetailUrl(data.data[0]);

                            window.addEventListener('keydown', e => {
                                if (e.which === 39) {
                                    window.location = this.next;
                                }
                            });
                        }
                    });

                if (category) {
                    this.fetchCollections(new URLSearchParams({category}))
                        .then(({data}) => {
                            if (data.data[0]) {
                                this.back = this.getCollectionUrl(data.data[0]);
                            }
                        });
                } else {
                    this.fetchArticles(new URLSearchParams({set}))
                        .then(({data}) => {
                            if (data.data[0]) {
                                this.back = this.getArticleUrl(data.data[0]);
                            }
                        })
                }
            });
    }
}
</script>
