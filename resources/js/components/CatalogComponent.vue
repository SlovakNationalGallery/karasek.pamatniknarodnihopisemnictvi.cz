<template>
    <div>
        <isotope :options="getOptions()" :list="items">
            <div v-for="item in items" :key="item.document.id" class="my-4 px-4 w-1/2 lg:w-1/3" data-grid-item>
                <a :href="getUrl(item)" class="relative block mb-2" :style="getStyle(item)">
                    <img :src="getImage(item, 800)" class="absolute left-0 top-0">
                </a>
                <a :href="getUrl(item)">
                    <em>{{ item.document.content.title }}</em><br>
                    <strong>{{ item.document.content.author[0] }}</strong><br>
                    <em>{{ item.document.content.dating }}</em>
                </a>
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
        this.fetch(this.initCount);
    },

    methods: {
        fetch(size) {
            const params = new URLSearchParams();
            params.append('category', this.category);
            params.append('size', size);
            return axios.get(this.endpoint, {
                    params: params,
                })
                .then(({data}) => {
                    this.hasMore = data.next_page_url !== null;
                    const items = data.data.slice(this.items.length);
                    this.items.push(...items);
                });
        },
        loadAll() {
            this.fetch(1000)
                .then(() => {
                    this.hasMore = false;
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
