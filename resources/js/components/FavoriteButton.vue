<template>
    <div class="container"  style="border:none">
        <a href="#" class="btn" style="border:none" @click.prevent="favoriteItem" title="Agregar a favoritos">
            <i class="fa-2x fa-star" style="border:none" :class="classObject"></i>
        </a>
    </div>
</template>

<script>
    export default {
        props: ['classified_id', 'favorited'],

        data: function (){
            return {
                status: this.favorited,
            }
        },

        methods: {
            favoriteItem() {
                axios.post('/favorites/' + this.classified_id)
                    .then(response => {
                        this.status = !this.status;
                    })
                    .catch(errors =>{
                        if (errors.response.status == 401){
                            window.location = '/login';
                        }
                    })
            }
        },

        computed: {
            classObject(){
                return {
                    'fas': this.status,
                    'far': !this.status
                }
            }
        }

    }
</script>

<style scoped>

    a{
        margin: 0;
        padding: 0;
    }

    .fa-heart {
        transition: 0.5s;

    }

    .fas {
        color: dodgerblue;
    }

</style>
