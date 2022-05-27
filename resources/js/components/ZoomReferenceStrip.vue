<template>
    <div class="overflow-y-scroll p-2" v-dragscroll>
        <div v-for="src, index in thumbnailUrls" :key="src">
            <slot name="tile" v-bind:src="src" v-bind:index="index" />
        </div>
    </div>
</template>

<script>
import { dragscroll } from 'vue-dragscroll'

export default {
    props: ['tileSources', 'currentPage'],

    directives: {
        dragscroll
    },

    computed: {
        thumbnailUrls() {
            return this.tileSources.map(ts => ts.replace(/\.dzi$/, "_files/0/0_0.jpg"))
        }
    },
}
</script>
