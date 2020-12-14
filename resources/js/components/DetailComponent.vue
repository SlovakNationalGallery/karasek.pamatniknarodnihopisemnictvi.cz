<template>
    <div class="max-w-6xl mx-auto" v-if="item">
        <div class="lg:flex lg:-mx-8 -my-8 lg:my-0 relative">

            <div class="absolute right-full">
                <a class="fixed text-6xl top-1/2 transform -translate-x-full -translate-y-1/2" :href="previous" v-if="previous">&larr;</a>
            </div>

            <div class="absolute left-full">
                <a class="fixed text-6xl top-1/2 transform -translate-y-1/2" :href="next" v-if="next">&rarr;</a>

                <div class="bottom-8 fixed font-medium text-center underline uppercase">
                    <a href="#">Nahoru</a><br>
                    <a href="#">Menu</a>
                </div>
            </div>

            <div class="my-8 lg:my-0 lg:mx-8 lg:w-1/2">
                <a :href="getZoomUrl(item)">
                    <img class="mx-auto" :src="getImage(item, 800)">
                </a>
            </div>
            <div class="my-8 lg:my-0 lg:w-1/2 lg:mx-8">
                <hr class="border-t-0.5 border-black">

                <h2 class="my-3 leading-tight text-2xl no-underline">
                    {{ item.document.content.author[0] }}
                    ({{ item.document.content.additionals.author_birth_year }}—{{ item.document.content.additionals.author_death_year}})</h2>

                <hr class="border-t-0.5 border-black">

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

                <p class="my-3">
                    {{ item.document.content.description }}
                </p>
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
        };
    },

    props: ['id'],

    created() {
        this.fetchItem(this.id)
            .then(({data}) => {
                this.item = data;
                const order = this.item.document.content.additionals.order;
                const params = new URLSearchParams();
                params.append('category', this.item.document.content.additionals.category);

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
            });
    }
}
</script>
