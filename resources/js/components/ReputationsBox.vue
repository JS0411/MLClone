<template>
    <div>    
        <div class="row mt-2 no-gutters justify-content-center" v-if="reputation.id != null">
            <div class="col-1 d-flex justify-content-center left-border"
                 :class="{'green': (reputation.rating == 'Positive'),
                 'red': (reputation.rating == 'Negative'),
                 'blue': (reputation.rating == 'Neutral')}"
            >
                <i class="fa fa-2x align-self-center"
                   :class="{'fa-plus-circle': (reputation.rating == 'Positive'),
                   'fa-minus-circle': (reputation.rating == 'Negative'),
                   'fas fa-dot-circle': (reputation.rating == 'Neutral') }">
                </i>
            </div>
            <div class="col-10 d-flex repitem right-border" style="">
                <img :src="'/storage/uploads/' + reputation.image" alt="Imagen de Publicacion">
                <div class="flex-grow-1 text-left text-container">
                    <a :href="'/classified/' + reputation.classified_id">
                        <h4 class="ml-2">{{reputation.classified_name}}</h4>
                    </a>
                    <hr>
                    <p class="ml-2">
                        {{reputation.description}}
                    </p>
                    <p class="text-right mr-2">
                        <a :href="'/userinfo/' + reputation.rater_id +'/reputation'" class="text-muted ">
                            {{mode == 'buyer' ? 'Vendedor' : 'Comprador'}}: {{reputation.rater_name}}
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['reputation', 'mode'],
        name: "Reputations",
    }
</script>

<style scoped>
    img {
        max-width: 100%;
        max-height: 100%;
        width: auto;
        height: auto;
        border-right: 2px black solid;
    }

    .repitem {
        max-height: 130px;
    }

    .left-border {
        border-style: solid;
        border-color: black;
        border-width: 2px 2px 2px 2px;
    }

    .right-border {
        border-style: solid;
        border-color: black;
        border-width: 2px 2px 2px 0px;
    }

    .repitem hr {
        margin: 0;
    }

    .text-container{
        word-break: break-all;
    }

    .red{
        background-color: red;
    }

    .green {
        background-color: rgba(15,201,61);
    }

    .blue {
        background-color: rgb(48, 126, 226);
    }


</style>
