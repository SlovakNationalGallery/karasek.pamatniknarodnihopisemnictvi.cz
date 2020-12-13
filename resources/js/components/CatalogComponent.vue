<template>
    <div>
        <div v-for="item in items">
            <a :href="getUrl(item)">
                <img :src="getImage(item, 800)">
            </a>
        </div>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            items: [],
            endpoint: '/api/items',
        }
    },

    props: ['category'],

    created() {
        this.fetch();
    },

    methods: {
        fetch() {
            const params = new URLSearchParams();
            params.append('category', this.category);
            params.append('size', 6);
            axios.get(this.endpoint, {
                    params: params,
                })
                .then(({data}) => {
                    this.items = data.data;
                });
        },
        getUrl(item) {
            return `/detail/${item.document.id}`;
        },
        // on button click load more items
    }
}
</script>
