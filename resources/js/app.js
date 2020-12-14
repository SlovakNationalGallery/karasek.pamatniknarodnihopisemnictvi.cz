require('./bootstrap');

window.Vue = require('vue');
window.Isotope = require('isotope-layout');

Vue.component('catalog-component', require('./components/CatalogComponent.vue').default);
Vue.component('detail-component', require('./components/DetailComponent.vue').default);

const common = {
    install: vue => {
        if (!vue.prototype.getImage) {
            vue.prototype.getImage = (item, size) => {
                return `${process.env.MIX_WEBUMENIA_URL}/dielo/nahlad/${item.document.id}/${size}`;
            };
        }
        if (!vue.prototype.getUrl) {
            vue.prototype.getUrl = item => {
                return `/detail/${item.document.id}`;
            }
        }
    }
}

Vue.use(common);

const app = new Vue({
    el: '#app',
});
