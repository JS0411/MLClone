<template>
    <div class="container">
        <h3 class="pt-3 text-center">Reputación del Usuario: {{user_name}}</h3>
        <reputations-filter @retrieve="retrieveReputations" @filter="filterReputations"></reputations-filter>
        <hr>
        <div v-if="optionSelect == false">
            <div class="text-center no-options">
                <strong>
                    Elige una opcion (Vendedor o Comprador) y presiona buscar para ver la reputación de este usuario!
                    <br>
                    Tambien puedes hacer uso de los filtros para ver mas en detalle la reputacion del usuario
                </strong>
            </div>
        </div>
        <div v-else>
            <div v-if="loading == true" class="d-block text-center">
                <i class="fa fa-5x fa-spinner fa-pulse"></i>
                <br>
                <strong>Cargando...</strong>
            </div>

            <div v-else>
                <h5 v-if="Object.keys(this.reputations).length == 0 && retrieved == true"
                    class="font-weight-bold text-center">
                    Este usuario no tiene reputacion como {{mode == 'buyer' ? 'comprador' : 'vendedor'}} todavia.
                </h5>
                <div v-else>
                    <h5 v-if="Object.keys(this.filteredReputations).length == 0" class="font-weight-bold text-center">
                        Este usuario no tiene reputacion bajo estos filtros.
                    </h5>
                    <div v-else>
                        <paginate class="pl-0" name="filteredReputations" :list="filteredReputations" :per="10">
                            <reputations-box
                                v-for="(reputation) in paginated('filteredReputations')"
                                :key="reputation.id"
                                :reputation="reputation"
                                :mode="mode">
                            </reputations-box>
                        </paginate>
                        <paginate-links for="filteredReputations" class="d-flex justify-content-center"
                                        :show-step-links="true"
                                        :classes="{'ul': 'pagination', 'li': 'page-item', 'a': 'page-link',
                                        'li.next > a': 'next-link', '.prev > a': 'prev-link'}">
                        </paginate-links>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user_id', 'user_name'],
        name: "Reputations",

        data() {
            return {
                optionSelect: false,
                loading: false,
                mode: '',
                retrieved: false,
                positive: '',
                neutral: '',
                negative: '',
                reputations: {
                    'id': '',
                    'classified_name': '',
                    'classified_id': '',
                    'description': '',
                    'rating': '',
                    'rater_id': '',
                    'rater_name': '',
                    'image': '',
                },
                filteredReputations: {
                    'id': '',
                    'classified_name': '',
                    'classified_id': '',
                    'description': '',
                    'rating': '',
                    'rater_id': '',
                    'rater_name': '',
                    'image': '',
                },
                paginate: ['filteredReputations'],
            }
        },

        methods: {
            retrieveReputations(setting, filters, changedFilters) {
                this.optionSelect = true;
                this.loading = true;
                this.retrieved = false;
                //This verifies if the mode has changed, and if so, sets the current status as a string for usage in the HTML
                if (this.mode != setting) {
                    this.mode = setting;
                    const params = {
                        id: this.user_id,
                        mode: this.mode,
                    }
                    axios.get('/reputations', {params}).then((response) => {
                        this.reputations = response.data;
                        this.retrieved = true;
                        this.filterReputations(filters, changedFilters);
                    });
                } else {
                    this.filterReputations(filters, changedFilters);
                }
            },

            filterReputations(filters, changedFilters) {
                if (filters.positive == filters.negative && filters.negative == filters.neutral) //If theres no changes, we return the same array.
                {
                    this.filteredReputations = this.reputations;
                } else if (changedFilters) {
                    this.filteredReputations = this.reputations.filter(function (reputation) {
                        return (reputation.rating == (filters.positive ? 'Positive' : '')
                            || reputation.rating == (filters.neutral ? 'Neutral' : '')
                            || reputation.rating == (filters.negative ? 'Negative' : ''));
                    });
                }
                this.loading = false;
            }
        },

    }
</script>

<style>
    ul.paginate-links > li.left-arrow > a ,
    ul.paginate-links > li.right-arrow > a ,
    ul.paginate-links > li.number > a {
        cursor:pointer; cursor:hand
    }

    ul.paginate-links > li.active > a {
        cursor:default;
    }

    .no-options {
        font-size: 1.3rem;
    }
</style>
