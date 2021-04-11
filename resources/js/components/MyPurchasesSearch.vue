<template>
        <ais-instant-search
            index-name="purchases"
            :search-client="searchClient"
        >
            <ais-configure
                :hitsPerPage="20"
                :filters = "filters"
            />
            <ais-search-box
                placeholder="Buscar..."
                :show-loading-indicator =  "true"
            >
            </ais-search-box>
            <div class="row mt-4 results-box ">
                <div class="col-3">
                    <div class="left-panel text-break">
                        <h2>Condición</h2>
                        <ais-refinement-list attribute="usage"/>
                        <hr>
                        <h2>Estado de {{$mode == 'bought' ? 'Compra' : 'Venta'}}</h2>
                        <classifieds-refinement attribute="active"/> <!-- Custom widget to show an active or inactive tag.-->
                    </div>
                </div>
                <div class="col-9 right-panel">
                    <ais-hits>
                        <div slot-scope="{items}">
                            <p v-if="items.length<=0">No se encontraron resultados para la busqueda...</p>
                            <div v-for="item in items">
                                <div class="item-bg d-flex">
                                    <a :href="'/purchase/' + item.id + '?mode=' + mode" class="d-flex">
                                        <img :src="'/storage/uploads/' + item.image" width="120" height="120">
                                        <span class="d-inline pl-3">
                                            <strong>{{item.name}}</strong>
                                            <p class="pt-3">{{item.location}}</p>
                                            <h5 >Bs. {{item.price}}</h5>
                                        </span>
                                    </a>
                                </div>
                                <hr>
                            </div>
                        </div>
                    </ais-hits>
                </div>
            </div>
            <ais-pagination/>

        </ais-instant-search>
</template>

<script>
    import algoliasearch from 'algoliasearch/lite';
    import 'instantsearch.css/themes/algolia-min.css';
    import { history as historyRouter } from 'instantsearch.js/es/lib/routers';
    import { singleIndex as singleIndexMapping } from 'instantsearch.js/es/lib/stateMappings';

    export default {
        props: ['user_id', 'mode'],

        data() {
            return {
                searchClient: algoliasearch(
                    'UKNF6XGHI9',
                    '163814f7269186a7b632ccf8870e2a1e',
                ),
            };
        },

        computed: {
            filters() {
                if (this.mode == "sold") {
                    return "seller_id: " + this.user_id +"";
                } else if (this.mode == "bought") {
                    return "buyer_id: " + this.user_id +"";
                }
            }
        }
    };
</script>

<style scoped>
    .left-panel{
        padding: 5px 0px 10px 10px;
        border-radius: 8px;
        border-style: solid;
    }

    strong{
        font-size: 19px;
    }

    .item-bg:hover{
        border: 4px solid rgb(85,85,85);
        border-radius: 8px;
        margin: -4px;
    }

    .dropdown {
        padding-top: 10px;
        padding-left: 10px;
    }
</style>
