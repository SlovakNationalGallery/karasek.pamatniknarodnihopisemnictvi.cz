import { stringify } from 'qs';

export const apiMixin = {
    data() {
        return {
            endpoints: {
                items: `${process.env.MIX_WEBUMENIA_API}/items`,
                aggregations: `${process.env.MIX_WEBUMENIA_API}/items/aggregations`,
            },
            defaultSearchParams: {
                'filter[additionals.frontend.keyword]': 'karasek.pamatniknarodnihopisemnictvi.cz',
                'locale': 'cs',
            }
        }
    },

    methods: {
        createParams() {
            return new URLSearchParams(this.defaultSearchParams);
        },
        addFilter(params, filter) {
            const p = stringify({filter}, {
                filter: (prefix, value) => {
                    if (value === null) {
                        return;
                    }
                    return value;
                }
            });
            const temp = new URLSearchParams(p);
            for (const [key, value] of temp.entries()) {
                params.append(key, value);
            }
        },
        fetchItem(id) {
            return axios.get(`${this.endpoints.items}/${id}?locale=cs`);
        },
        fetchItems(params) {
            return axios.get(this.endpoints.items, {params});
        },
        fetchAggregations(params) {
            return axios.get(this.endpoints.aggregations, {params});
        },
    }
};
