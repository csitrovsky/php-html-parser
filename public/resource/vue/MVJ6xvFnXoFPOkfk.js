Vue.component('vue-search', {
    template: '#template-search',
    props: {},
    data: function() {
        return {
            loading: true,
            tags: {},
            unknown: 'https://csitrovsky.ru',
        };
    },
    filters: {},
    methods: {
        get: async function() {
            var url = '/api/parser/html/post';
            const response = await axios.post(url, {
                headers: {'Content-Type': 'application/json'},
                url: this.unknown,
            }).
                then((response) => {
                    results = response.data;
                    if ($.inArray('tags', results)) {
                        Vue.set(this, 'tags', results.tags);
                        console.log(this.tags);
                    }
                }).
                catch((err) => {return false;});
        },
    },
    computed: {},
    mounted: async function() {
        this.get();
    },
    watch: {
        unknown: {
            handler(value) {
                console.log(this.unknown);
            },
            deep: true,
        },
    },
});

const vm = new Vue({
    el: '#root',
    data: function() {
        return {
            url: {},
            status: true,
            query: {},
        };
    },
    methods: {},
    mounted: async function() {},
});