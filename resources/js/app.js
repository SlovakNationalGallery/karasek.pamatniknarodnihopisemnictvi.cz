import Vue from 'vue';
import VueRouter from 'vue-router';
import qs from 'qs';
import CatalogComponent from "./components/CatalogComponent";

require('./bootstrap');

window._ = require('lodash');
window.OpenSeadragon = require('openseadragon');

Vue.component('catalog-component', require('./components/CatalogComponent').default);
Vue.component('grid-component', require('./components/GridComponent').default);
Vue.component('detail-component', require('./components/DetailComponent').default);
Vue.component('zoom-component', require('./components/ZoomComponent').default);

const common = {
    install: vue => {
        const endpoints = {
            articles: '/api/articles',
            collections: '/api/collections',
        };

        vue.prototype.endpoints = endpoints;

        vue.prototype.getImage = (item, size) => {
            return `${process.env.MIX_WEBUMENIA_URL}/dielo/nahlad/${item.document.id}/${size}`;
        };
        vue.prototype.getDetailUrl = item => {
            return `/detail/${item.document.id}`;
        };
        vue.prototype.getZoomUrl = item => {
            return `/zoom/${item.document.id}`;
        };
        vue.prototype.getArticleUrl = article => {
            return `/${article.slug}`;
        };
        vue.prototype.getCollectionUrl = collection => {
            return `/${collection.article.slug}#${collection.slug}`;
        };
        vue.prototype.fetchArticles = (params) => {
            return axios.get(endpoints.articles, {
                params: params,
            });
        };
        vue.prototype.fetchCollections = (params) => {
            return axios.get(endpoints.collections, {
                params: params,
            });
        };
        vue.prototype.formatName = name => {
            return name.replace(/^([^,]*),\s*(.*)$/, '$2 $1');
        };
        vue.prototype.getAuthor = item => {
            return vue.prototype.formatName(item.document.content.author.join(', '));
        };
        vue.prototype.debounceScroll = _.debounce(() => {
            const id = window.location.hash.substring(1);
            const el = document.getElementById(id);
            if (el) {
                el.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        }, 500);
    }
}

const router = new VueRouter({
    parseQuery(query) {
        return qs.parse(query);
    },
    stringifyQuery(query) {
        const result = qs.stringify(query, {
            filter: (prefix, value) => {
                if (value === null) {
                    return;
                }
                return value;
            },
            encodeValuesOnly: true
        });
        return result ? ('?' + result) : '';
    }
});

Vue.use(common);
Vue.use(VueRouter);

const app = new Vue({
    el: '#app',
    router
});
