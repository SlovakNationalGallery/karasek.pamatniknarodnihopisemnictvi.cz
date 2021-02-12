<template>
    <div>
        <div class="flex flex-wrap font-medium my-8 lg:my-16 -mx-4">
            <div class="mb-4 px-4 w-1/2 md:w-1/4">
                <v-select v-model="query.filter.author" :options="options.author" label="key" :reduce="option => option.key" @input="updateFilterDebounced" :components="{OpenIndicator}" placeholder="Autor">
                    <template v-slot:selected-option="option">
                        {{ formatName(option.key) }}
                    </template>
                    <template v-slot:option="option">
                        {{ formatName(option.key) }} [{{ option.doc_count }}]
                    </template>
                </v-select>
            </div>

            <div class="mb-4 px-4 w-1/2 md:w-1/4">
                <v-select v-model="query.filter.topic" :options="options.topic" label="key" :reduce="option => option.key" @input="updateFilterDebounced" :components="{OpenIndicator}" placeholder="Námět">
                    <template v-slot:option="option">
                        {{ option.key }} [{{ option.doc_count }}]
                    </template>
                </v-select>
            </div>

            <div class="mb-4 px-4 w-full md:w-1/2">
                <slider-component v-model="years"
                                  v-if="options.yearMin && options.yearMax"
                                  :min="options.yearMin"
                                  :max="options.yearMax"
                                  :duration="0"
                                  :height="2"
                                  :dotSize="12"
                                  tooltip="none"
                                  @change="updateFilterDebounced"
                ></slider-component>
                <div class="flex justify-between" v-if="years">
                    <span>{{ years[0] }}</span>
                    <span>{{ years[1] }}</span>
                </div>
            </div>
        </div>
        <grid-component :filter="query.filter"></grid-component>
    </div>
</template>

<script>
import _ from 'lodash';
import VueSlider from "vue-slider-component";
import VueSelect from "vue-select";
import { apiMixin } from '../mixins';

export default {
    mixins: [apiMixin],

    data() {
        return {
            query: {
                filter: {
                    author: null,
                    topic: null,
                    date_latest: { gte: null },
                    date_earliest: { lte: null },
                },
            },
            options: {
                author: [],
                topic: [],
                yearMin: null,
                yearMax: null,
            },
            OpenIndicator: {
                render: createElement => createElement('span', '↓')
            },
        }
    },

    computed: {
        years: {
            set(value) {
                this.query.filter.date_latest.gte = value[0];
                this.query.filter.date_earliest.lte = value[1];
            },
            get() {
                return [
                    this.query.filter.date_latest.gte ?? this.options.yearMin,
                    this.query.filter.date_earliest.lte ?? this.options.yearMax,
                ];
            }
        },
    },

    created() {
        this.updateFilterDebounced = _.debounce(this.updateFilter, 300);
        this.query = _.merge(this.query, this.$route.query);
        this.$watch('query', function (value) {
            this.$router.replace({ query: value });
        }, {
            deep: true,
        });
    },

    mounted() {
        this.updateFilterDebounced();
        this.updateYearsRange();
    },

    methods: {
        updateFilter() {
            const params = this.createParams();
            this.addFilter(params, this.query.filter);
            params.append('size', 1000);
            const terms = ['author', 'topic'];
            terms.forEach(field => {
                params.append(`terms[${field}]`, field);
            });
            this.fetchAggregations(params)
                .then(({data}) => {
                    terms.forEach(field => {
                        this.$set(this.options, field, data[field].buckets);
                    });
                });
        },
        updateYearsRange() {
            const params = this.createParams();
            params.append('min[min_date]', 'date_earliest');
            params.append('max[max_date]', 'date_latest');
            this.fetchAggregations(params)
                .then(({data}) => {
                    this.$set(this.options, 'yearMin', data['min_date'].value);
                    this.$set(this.options, 'yearMax', data['max_date'].value);
                });
        },
    },

    components: {
        'slider-component': VueSlider,
        'v-select': VueSelect,
    }
}
</script>
