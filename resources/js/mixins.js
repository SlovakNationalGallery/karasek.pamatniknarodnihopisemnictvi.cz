import { stringify } from 'qs';

export const apiMixin = {
    data() {
        return {
            endpoints: {
                items: `${process.env.MIX_WEBUMENIA_API}/items`,
                aggregations: `${process.env.MIX_WEBUMENIA_API}/items/aggregations`,
            },
            defaultSearchParams: {
                'filter[additionals.frontend]': 'karasek.pamatniknarodnihopisemnictvi.cz',
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
        fetchItems(params) {
            params.append('locale', 'cs');
            return axios.get(this.endpoints.items, {
                params: params,
            });
        },
        fetchItem(id) {
            return axios.get(`${this.endpoints.items}/${id}?locale=cs`);
        },
    }
};
