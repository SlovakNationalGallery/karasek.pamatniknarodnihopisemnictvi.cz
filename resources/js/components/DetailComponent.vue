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
                        {{ getAuthor(item) }}
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
                            Námět: {{ item.document.content.topic.join(', ') }}<br>
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
export default {
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
                const params = new URLSearchParams();
                const set = this.item.document.content.additionals.set;
                const category = this.item.document.content.additionals.category;
                if (category) {
                    params.append('category', category);
                } else {
                    params.append('set', set);
                }

                const prevParams = new URLSearchParams(params);
                prevParams.append('order[lt]', order);
                prevParams.append('sort[additionals.order]', 'desc');
                this.fetchItems(prevParams)
                    .then(({data}) => {
                        if (data.data[0]) {
                            this.previous = this.getDetailUrl(data.data[0]);
                        }
                    });

                const nextParams = new URLSearchParams(params);
                nextParams.append('order[gt]', order);
                nextParams.append('sort[additionals.order]', 'asc');
                this.fetchItems(nextParams)
                    .then(({data}) => {
                        if (data.data[0]) {
                            this.next = this.getDetailUrl(data.data[0]);
                        }
                    });

                if (category) {
                    this.fetchCollections(params)
                        .then(({data}) => {
                            if (data.data[0]) {
                                this.back = this.getCollectionUrl(data.data[0]);
                            }
                        });
                } else {
                    this.fetchArticles(params)
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
