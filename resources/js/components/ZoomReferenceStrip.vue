<template>
    <div v-dragscroll>
        <slot v-bind:thumbnailUrls="thumbnailUrls" />
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
