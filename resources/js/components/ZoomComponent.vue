<template>
    <div>
        <div id="viewer" class="absolute h-full left-0 m-0 min-h-full p-0 top-0 w-full"></div>
        <a class="absolute bg-white border-black border-0.5 font-medium left-0 m-8 opacity-60 active:opacity-100 hover:opacity-100 px-4 py-3 top-0 z-50" :href="backUrl" role="button" data-return>&larr; Zpět</a>
    </div>
</template>

<script>
import { apiMixin } from '../mixins';

export default {
    mixins: [apiMixin],

    data() {
        return {
            item: null,
        };
    },

    props: ['id', 'backUrl'],

    mounted() {
        this.fetchItem(this.id)
            .then(({data}) => {
                this.item = data;
                this.initViewer();
            });
    },

    methods: {
        initViewer() {
            const options = {
                id: 'viewer',
                showNavigationControl: false,
                showNavigator: false,
                visibilityRatio: 1,
                minZoomLevel: 0,
                defaultZoomLevel: 0,
                autoResize: false,
                tileSources: [`https://img.webumenia.sk/zoom/?path=${this.item.document.content.images[0]}.dzi`]
            };

            this.viewer = OpenSeadragon(options);

            window.addEventListener('resize', () => {
                var newSize = new OpenSeadragon.Point(window.innerWidth, window.innerHeight);
                this.viewer.viewport.resize(newSize, false);
                this.viewer.viewport.goHome(true);
                this.viewer.forceRedraw();
            });

            this.viewer.canvas.addEventListener('contextmenu', e => {
                e.preventDefault();
            });

            document.querySelector('[data-return]').addEventListener('click', e => {
                e.preventDefault();
                if (document.referrer.split('/')[2] === window.location.host) {
                    window.history.back();

                    // fallback when opening in new tab/window and history.back() is disabled but referrer is defined
                    setTimeout(() => {
                        window.location.href = this.backUrl;
                    }, 500);
                } else {
                    window.location.href = this.backUrl;
                }
            });
        }
    }
}
</script>
