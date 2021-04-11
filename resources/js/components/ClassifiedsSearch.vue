<template>
    <div class="">
        <transition name="fade" mode="out-in">
            <div class="d-flex justify-content-center">
                <div v-if="!resultsLoaded"  class="pt-4 mx-auto text-center" >
                    <strong>Cargando resultados...</strong>
                    <br>
                    <i class="mt-3 fas fa-5x fa-spinner fa-spin fa-pulse"></i>
                </div>
            </div>
        </transition>
        <transition name="fade" mode="out-in">
            <div v-show="resultsLoaded" >
                <ais-instant-search
                    index-name="classifieds"
                    :search-client="searchClient"
                    :routing="routing"
                >
                    <hits-connector
                        @loaded="showResults"
                    >
                    </hits-connector>
                    <ais-configure
                        :hitsPerPage="20"
                        filters="active:1"
                    />
                    <virtual-searchbox></virtual-searchbox> <!--Uses the searchbox logic for the initial query, without rendering-->
                    <div class="row mt-4 results-box ">
                        <div class="col-3">
                            <div class="left-panel text-break">
                                <h2>Categorias</h2>
                                <ais-refinement-list attribute="category"/>
                                <hr>
                                <h2>Ubicación</h2>
                                <ais-refinement-list attribute="location"/>
                                <hr>
                                <h2>Condición</h2>
                                <ais-refinement-list attribute="usage"/>
                                <hr>
                                <h2>Ordenar Por:</h2>
                                <ais-sort-by
                                    :items="[
                            { value: 'classifieds', label: 'Relevancia' },
                            { value: 'price_asc', label: 'Precio asc.' },
                            { value: 'price_desc', label: 'Precio desc.' },
                          ]"
                                />
                            </div>
                        </div>
                        <div class="col-9 right-panel">
                            <ais-hits>
                                <div slot-scope="{items}">
                                    <p v-if="items.length<=0">No se encontraron resultados para la busqueda...</p>
                                    <div v-for="item in items">
                                        <a :href="'/classified/' + item.id">
                                            <div class="item-bg d-flex">
                                                <img :src="'/storage/uploads/' + item.images[0].URI" width="120" height="120">
                                                <span class="d-inline pl-3">
                                            <strong>{{item.name}}</strong>
                                            <p class="pt-3">{{item.location}}</p>
                                      <h5 >Bs. {{item.price}}</h5>
                                        </span>
                                            </div>
                                        </a>
                                        <hr>
                                    </div>
                                </div>
                            </ais-hits>
                        </div>
                    </div>
                    <ais-pagination/>

                </ais-instant-search>
            </div>
        </transition>

    </div>

</template>

<script>
    import algoliasearch from 'algoliasearch/lite';
    import 'instantsearch.css/themes/algolia-min.css';
    import { history as historyRouter } from 'instantsearch.js/es/lib/routers';
    import { singleIndex as singleIndexMapping } from 'instantsearch.js/es/lib/stateMappings';
    export default {
        props: ['searchquery'],


        data() {
            return {
                resultsLoaded: false,
                searchClient: algoliasearch(
                    'UKNF6XGHI9',
                    '163814f7269186a7b632ccf8870e2a1e',
                ),
                routing: {
                    router: historyRouter(),
                    stateMapping: singleIndexMapping('classifieds'),
                },
            };
        },

        mounted() {

        },

        methods: {
            showResults(){
                console.log("test");
                this.resultsLoaded = true;
            }
        },

    };
</script>

<style scoped>

    .left-panel{
        padding: 5px 0px 10px 10px;
        border-radius: 8px;
        border-style: solid;
    }

    a:hover{
        color: black;
    }

    strong{
        font-size: 19px;
    }

    .item-bg{
    }

    .item-bg:hover{
        border: 4px solid rgb(85,85,85);
        border-radius: 8px;
        margin: -4px;
    }

    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
    }
</style>
