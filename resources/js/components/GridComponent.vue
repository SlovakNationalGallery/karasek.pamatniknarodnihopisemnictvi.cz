<template>
    <div class="mb-14 lg:mb-28 -mt-4 lg:-mt-6 -mx-4 lg:-mx-6" v-if="items.length">
        <isotope :options="getIsotopeOptions()" :list="items">
            <div v-for="item in items" :key="item.document.id" class="my-4 lg:my-6 px-4 lg:px-6 w-1/2 lg:w-1/3 leading-tight lg:leading-tight text-sm lg:text-base" data-grid-item>
                <a :href="getDetailUrl(item)" class="relative block" :style="getPaddingBottom(item)">
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

        <div class="text-center" v-if="nextPage">
            <button class="active:bg-gray-100 hover:bg-gray-100 border-black border-0.5 font-medium px-4 py-3" v-on:click="loadNext(nextPage)">Další díla</button>
        </div>
    </div>
</template>

<script>
import isotope from 'vueisotope';
import { debounce } from 'lodash';
import { apiMixin } from '../mixins';

export default {
    mixins: [apiMixin],

    data: function () {
        return {
            items: [],
            nextPage: null,
            options: {
                itemSelector: '[data-grid-item]',
                percentPosition: true,
            }
        }
    },

    props: {
        perPage: {
            type: Number,
            default: 12
        },
        filter: {
            type: Object,
            default: function () {
                return {}
            }
        }
    },

    created() {
        this.debouncedLoad = debounce(this.load, 300);
        this.$watch('filter', this.debouncedLoad, {
            deep: true
        });
    },

    mounted() {
        this.load();
    },

    methods: {
        load() {
            const params = this.getSearchParams();
            this.fetchItems(params)
                .then(({data}) => {
                    this.nextPage = data.next_page_url;
                    this.items = data.data;
                    this.debounceScroll();
                });
        },
        loadNext(nextPage) {
            this.nextPage = null;
            axios.get(nextPage)
                .then(({data}) => {
                    this.nextPage = data.next_page_url;
                    this.items.push(...data.data);
                });
        },
        getSearchParams() {
            const params = this.createParams();
            this.addFilter(params, this.filter);
            params.append('size', this.perPage);
            return params;
        },
        getPaddingBottom(item) {
            const ratio = item.document.content.image_ratio || .875;
            const paddingBottom = 100 / ratio;
            return `padding-bottom: ${paddingBottom}%;`;
        },
        getIsotopeOptions() {
            return {
                itemSelector: '[data-grid-item]',
                percentPosition: true,
            };
        },
    },

    components: {
        isotope
    }
}
</script>
