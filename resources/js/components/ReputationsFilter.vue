<template>
    <div class="container text-center pt-2 ratings">
        <div class="row justify-content-center as-selector">
            <div class="col-6 mode-select" :class="{selectedMode:clickedSeller}">
                <a href="" @click.prevent="setMode('seller')">
                    <h3 class="pt-2">Como Vendedor</h3>
                </a>
            </div>
            <div class="col-6 mode-select" :class="{selectedMode:clickedBuyer}">
                <a href="" @click.prevent="setMode('buyer')">
                    <h3 class="pt-2">Como Comprador</h3>
                </a>
            </div>
        </div>
        <div class="row justify-content-center">
            <a href="" @click.prevent="setFilters('positive')" class="col-4 positive"
               :class="{selectedPositive:filters.positive}">
                <h3>Positivas</h3>
                <i class="fa fa-2x fa-plus-circle"></i>
            </a>
            <a href="" @click.prevent="setFilters('negative')" class="col-4 negative"
               :class="{selectedNegative:filters.negative}">
                <h3>Negativas</h3>
                <i class="fa fa-2x fa-minus-circle"></i>
            </a>
            <a href="" @click.prevent="setFilters('neutral')" class="col-4 neutral"
               :class="{selectedNeutral:filters.neutral}">
                <h3>Neutrales</h3>
                <i class="fas fa-2x fa-dot-circle"></i>
            </a>
        </div>
        <a href="#" @click.prevent="emitSearch()" class="row ">
            <h5 class="col-12 search-button">Buscar<i class="ml-2 fa fa-search"></i>
            </h5>
        </a>
    </div>
</template>

<script>
    export default {
        name: "Reputations",

        data() {
            return {
                //Booleans to set the colors and statuses for the searches.
                clickedSeller: false,
                clickedBuyer: false,
                changedMode: false, //This one allows the program to know if there has been changes in the mode.
                changedFilters: true, //Same, but for filters, starts out as true for the initial render.
                setting: '',
                filters: {
                    positive: false,
                    neutral: false,
                    negative: false,
                },
            }
        },

        methods: {
            setMode(setting) {
                //Sets the setting to the desired type, and verifies that only its button is active
                if (setting == 'seller') {
                    if (this.clickedSeller == false) {
                        this.clickedSeller = true;
                        this.clickedBuyer = false;
                        this.changedMode = true;
                    }
                    this.setting = 'seller';
                } else {
                    if (this.clickedBuyer == false) {
                        this.clickedBuyer = true;
                        this.clickedSeller = false;
                        this.changedMode = true;
                    }
                    this.setting = 'buyer';
                }
            },

            setFilters(filter) {
                if (filter == 'positive') {
                    this.filters.positive = !this.filters.positive;
                } else if (filter == 'negative') {
                    this.filters.negative = !this.filters.negative;
                } else {
                    this.filters.neutral = !this.filters.neutral;
                }
                this.changedFilters = true;
            },

            emitSearch() {
                if (this.setting != '' && (this.changedMode || this.changedFilters)) {
                    //First the method checks if the mode has changed
                    this.changedMode = false;
                    this.$emit('retrieve', this.setting, this.filters, this.changedFilters);
                    this.changedFilters = false;

                }
            }
        },
    }
</script>

<style scoped>
    a {
        text-decoration: none;
        color: black;
    }

    .mode-select {
        background-color: rgba(250, 206, 62, 0.73);
        transition: 0.5s;
    }

    .mode-select:first-of-type {
        border-right: 1px black solid;
    }

    .selectedMode {
        background-color: rgba(224, 174, 18, 1);

    }

    .positive {
        background-color: rgba(15, 201, 61, 0.58);
        transition: 0.5s;
        border-right: 1px black solid;
    }

    .selectedPositive {
        background-color: rgb(15, 201, 61);
    }

    .negative {
        background-color: rgba(198, 39, 20, 0.62);
        transition: 0.5s;
        border-right: 1px black solid;
    }

    .selectedNegative {
        background-color: rgb(198, 39, 20);
    }

    .neutral {
        background-color: rgba(60, 132, 219, 0.6);
        transition: 0.5s;
    }

    .selectedNeutral {
        background-color: rgb(48, 126, 226);
    }

    .search-button {
        background-color: #c6c6c6;
        transition: 0.5s
    }

    .search-button:hover {
        background-color: #808080;

    }

</style>
