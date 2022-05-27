<template>
  <div ref="carousel">
    <slot :selectedIndex="selectedIndex" :select="select"></slot>
  </div>
</template>

<script>
import Flickity from 'flickity-imagesloaded'

export default {
  props: {
    options: Object,
  },
  data() {
    return {
      slides: [],
      selectedIndex: null,
    }
  },
  mounted() {
    const vm = this
    this.flickity = new Flickity(this.$refs.carousel, {
      on: {
        ready() {
          vm.slides = this.slides
          vm.selectedIndex = this.selectedIndex
        },
        change(index) {
          vm.selectedIndex = index
          vm.$emit('change', index)
        },
      },
      ...this.options,
    })
  },
  methods: {
    next() {
      this.flickity.next()
    },
    previous() {
      this.flickity.previous()
    },
    select(index) {
      this.flickity.select(index)
    },
  }
}
</script>
