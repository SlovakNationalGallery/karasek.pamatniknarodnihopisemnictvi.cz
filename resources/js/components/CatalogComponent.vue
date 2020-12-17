<template>
    <div class="mb-14 lg:mb-28 -mt-4 lg:-mt-6 -mx-4 lg:-mx-6" v-if="items.length">
        <isotope :options="getOptions()" :list="items">
            <div v-for="item in items" :key="item.document.id" class="my-4 lg:my-6 px-4 lg:px-6 w-1/2 lg:w-1/3 leading-tight lg:leading-tight text-sm lg:text-base" data-grid-item>
                <a :href="getDetailUrl(item)" class="relative block" :style="getStyle(item)">
                    <img :src="getImage(item, 800)" class="absolute left-0 top-0">
                </a>

                <div class="flex mt-4 justify-between">
                    <div>
                        <p class="my-1"><a :href="getDetailUrl(item)">{{ item.document.content.title }}</a></p>
                        <p class="my-1 font-medium"><a :href="getDetailUrl(item)">{{ getAuthor(item) }}</a></p>
                        <p class="mt-1"><a :href="getDetailUrl(item)">{{ item.document.content.dating }}</a></p>
                    </div>

                    <div class="pl-5">
                        <a :href="getZoomUrl(item)" class="opacity-50 hover:opacity-100">
                            <i class="fa fa-search-plus text-xl"><span class="sr-only">Zoom</span></i>
                        </a>
                    </div>
                </div>
            </div>
        </isotope>

        <div class="text-center" v-if="hasMore">
            <button class="active:bg-gray-100 hover:bg-gray-100 border-black border-0.5 font-medium px-4 py-3" v-on:click.once="loadAll()">Všechna díla</button>
        </div>
    </div>
</template>

<script>
import isotope from 'vueisotope';

export default {
    data: function () {
        return {
            items: [],
            endpoint: '/api/items',
            initCount: 6,
            hasMore: false,
            options: {
                itemSelector: '[data-grid-item]',
                percentPosition: true,
            }
        }
    },

    props: ['category'],

    mounted() {
        const params = new URLSearchParams();
        params.append('category', this.category);
        params.append('size', this.initCount);
        this.fetchItems(params)
            .then(({data}) => {
                this.hasMore = data.next_page_url !== null;
                this.items = data.data;
                this.debounceScroll();
            });
    },

    methods: {
        loadAll() {
            const params = new URLSearchParams();
            params.append('category', this.category);
            params.append('size', 1000);
            this.fetchItems(params)
                .then(({data}) => {
                    this.hasMore = false;
                    const items = data.data;
                    this.items.push(...items.slice(this.items.length));
                });
        },
        getStyle(item) {
            const ratio = item.document.content.image_ratio || .875;
            const paddingBottom = 100 / ratio;
            return `padding-bottom: ${paddingBottom}%;`;
        },
        getOptions() {
            return {
                itemSelector: '[data-grid-item]',
                percentPosition: true,
            };
        }
    },

    components: {
        isotope
    }
}
</script>
