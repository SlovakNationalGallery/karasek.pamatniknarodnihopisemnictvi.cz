require('./bootstrap');

window.Vue = require('vue');
window.$ = require('jquery');
window.OpenSeadragon = require('openseadragon');

Vue.component('catalog-component', require('./components/CatalogComponent.vue').default);
Vue.component('detail-component', require('./components/DetailComponent.vue').default);
Vue.component('zoom-component', require('./components/ZoomComponent').default);

const common = {
    install: vue => {
        const endpointItems = '/api/items';
        const endpointCollections = '/api/collections';
        vue.prototype.getImage = (item, size) => {
            return `${process.env.MIX_WEBUMENIA_URL}/dielo/nahlad/${item.document.id}/${size}`;
        };
        vue.prototype.getDetailUrl = item => {
            return `/detail/${item.document.id}`;
        };
        vue.prototype.getZoomUrl = item => {
            return `/zoom/${item.document.id}`;
        };
        vue.prototype.getCollectionUrl = collection => {
            return `/${collection.article.slug}#${collection.slug}`;
        };
        vue.prototype.fetchItems = (params) => {
            return axios.get(endpointItems, {
                params: params,
            });
        };
        vue.prototype.fetchItem = id => {
            return axios.get(`${endpointItems}/${id}`);
        };
        vue.prototype.fetchCollections = (params) => {
            return axios.get(endpointCollections, {
                params: params,
            });
        };
        vue.prototype.formatName = name => {
            return name.replace(/^([^,]*),\s*(.*)$/, '$2 $1');
        };
        vue.prototype.getAuthor = item => {
            return vue.prototype.formatName(item.document.content.author[0]);
        };
    }
}

Vue.use(common);

const app = new Vue({
    el: '#app',
});
