require('./bootstrap');

window.Vue = require('vue');
window.$ = require('jquery');
window.OpenSeadragon = require('openseadragon');

Vue.component('catalog-component', require('./components/CatalogComponent.vue').default);
Vue.component('detail-component', require('./components/DetailComponent.vue').default);
Vue.component('zoom-component', require('./components/ZoomComponent').default);

const common = {
    install: vue => {
        const endpoint = '/api/items';
        vue.prototype.getImage = (item, size) => {
            return `${process.env.MIX_WEBUMENIA_URL}/dielo/nahlad/${item.document.id}/${size}`;
        };
        vue.prototype.getDetailUrl = item => {
            return `/detail/${item.document.id}`;
        };
        vue.prototype.getZoomUrl = item => {
            return `/zoom/${item.document.id}`;
        };
        vue.prototype.fetchItems = (params) => {
            return axios.get(endpoint, {
                params: params,
            });
        };
        vue.prototype.fetchItem = id => {
            return axios.get(`${endpoint}/${id}`);
        }
    }
}

Vue.use(common);

const app = new Vue({
    el: '#app',
});
