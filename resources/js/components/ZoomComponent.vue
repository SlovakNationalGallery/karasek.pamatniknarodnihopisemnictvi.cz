<template>
    <div @mousemove="resetControlsAutoHideTimerThrottled">
        <div id="viewer" class="absolute h-full left-0 m-0 min-h-full p-0 top-0 w-full"></div>
        <a class="absolute bg-white border-black border-0.5 font-medium left-0 m-8 opacity-60 active:opacity-100 hover:opacity-100 px-4 py-3 top-0 z-50"
            :href="backUrl" role="button" data-return>&larr; Zpět</a>

        <Transition v-if="item && tileSources.length > 1" enter-class="opacity-0"
            enter-active-class="transition-opacity duration-300" enter-to-class="opacity-100" leave-class="opacity-100"
            leave-active-class="transition-opacity duration-1000" leave-to-class="opacity-0">
            <div v-if="showControls">

                <!-- Page count indicator -->
                <div class="absolute inset-x-0 bottom-0 flex justify-center pb-8">
                    <div class="bg-white opacity-60 px-4 py-2">
                        {{ page + 1 }} / {{ this.item.document.content.images.length }}
                    </div>
                </div>

                <ReferenceStrip class="absolute inset-y-0 right-0 bg-white bg-opacity-60" :tile-sources="tileSources">
                    <template v-slot:tile="{ src, index }">
                        <img :src="src"
                            :class='["w-40 p-2 m-2 border cursor-pointer border-black", page === index ? "border-opacity-100" : "border-opacity-0 hover:border-opacity-10"]'
                            v-on:click="goToPage(index)" />
                    </template>
                </ReferenceStrip>
            </div>
        </Transition>
    </div>
</template>

<script>
import { apiMixin } from '../mixins';
import ReferenceStrip from './ZoomReferenceStrip';
import _ from 'lodash';

const AutoHideTimeoutInMs = 3000

export default {
    mixins: [apiMixin],
    components: { ReferenceStrip },

    data() {
        return {
            item: null,
            page: 0,
            showControls: true,
        };
    },

    props: ['id', 'backUrl'],

    created() {
        this.resetControlsAutoHideTimerThrottled = _.throttle(this.resetControlsAutoHideTimer, 500)
        this.resetControlsAutoHideTimer()
    },

    mounted() {

        this.fetchItem(this.id)
            .then(({ data }) => {
                this.item = data;
                this.initViewer();
            });
    },

    computed: {
        tileSources() {
            return this.item.document.content.images.map(image => `https://img.webumenia.sk/zoom/?path=${image}.dzi`)
        },
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
                sequenceMode: this.tileSources.length > 1,
                tileSources: this.tileSources,
                showNavigationControl: false,
                showSequenceControl: false,
            };

            this.viewer = OpenSeadragon(options)

            window.addEventListener('resize', () => {
                var newSize = new OpenSeadragon.Point(window.innerWidth, window.innerHeight);
                this.viewer.viewport.resize(newSize, false);
                this.viewer.viewport.goHome(true);
                this.viewer.forceRedraw();
            });

            this.viewer.addHandler('page', ({ page }) => {
                this.page = page
            });

            this.viewer.addHandler('pan',this.resetControlsAutoHideTimerThrottled);

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
        },
        goToPage(page) {
            this.viewer.goToPage(page)
        },

        resetControlsAutoHideTimer() {
            this.showControls = true

            if (this.autoHideTimeout) clearTimeout(this.autoHideTimeout)

            this.autoHideTimeout = setTimeout(() => {
                this.showControls = false
            }, AutoHideTimeoutInMs)
        }
    }
}
</script>
