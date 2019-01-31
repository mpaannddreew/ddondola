<template>
    <form action="#" class="w-100" :class="classObject">
        <div class="input-group input-group-seamless ml-3">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="material-icons">search</i>
                </div>
            </div>
            <input style="padding-left: 1.875rem;" class="navbar-search form-control" id="search" type="text" placeholder="Search" aria-label="Search">
        </div>
    </form>
</template>

<script>
    export default {
        name: "Search",
        mounted() {
            this.initSearch();
        },
        data() {
            return {
                states: ['Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California',
                    'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii',
                    'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana',
                    'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota',
                    'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire',
                    'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota',
                    'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island',
                    'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont',
                    'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'
                ]
            }
        },
        props: {
            sideSearch: {
                type: Boolean,
                default: false
            }
        },
        computed: {
            classObject() {
                return {
                    'main-sidebar__search': this.sideSearch,
                    'border-right': this.sideSearch,
                    'd-sm-flex': this.sideSearch,
                    'd-md-none': this.sideSearch,
                    'd-lg-none': this.sideSearch,
                    'main-navbar__search': !this.sideSearch,
                    'd-none': !this.sideSearch,
                    'd-md-flex': !this.sideSearch,
                    'd-lg-flex': !this.sideSearch,
                }
            }
        },
        methods: {
            initSearch() {
                $('#search').typeahead({
                        hint: true,
                        highlight: true,
                        minLength: 1,
                        classNames: {
                            wrapper: "dropdown w-100 navbar-search form-control border-0 p-0",
                            input: "navbar-search form-control h-100",
                            hint: "navbar-search form-control h-100",
                            menu: "dropdown-menu dropdown-menu-small w-100 border-top-radius-0",
                            // dataset: "",
                            // suggestion: "",
                            // selectable: "",
                            // empty: "",
                            open: "show",
                            // cursor: "",
                            // highlight: ""
                        }
                    },
                    {
                        name: 'states',
                        source: this.substringMatcher(this.states),
                        templates: {
                            notFound: '<a class="dropdown-item notification__all text-center" href="#"> No matches found </a>',
                            suggestion: function(data) {
                                return '<a class="dropdown-item" href="#">' + data + '</a>';
                            }
                        }
                    });
            },
            substringMatcher: function(strs) {
                return function findMatches(q, cb) {
                    let matches, substrRegex;

                    // an array that will be populated with substring matches
                    matches = [];

                    // regex used to determine if a string contains the substring `q`
                    substrRegex = new RegExp(q, 'i');

                    // iterate through the pool of strings and for any string that
                    // contains the substring `q`, add it to the `matches` array
                    $.each(strs, function(i, str) {
                        if (substrRegex.test(str)) {
                            matches.push(str);
                        }
                    });

                    cb(matches);
                };
            }
        }
    }
</script>

<style scoped>

</style>