<template>
    <div>
        <div class="d-flex align-content-center pb-4">
            <img :src="getImgUrl(this.classified.image)" width="200" height="200">
            <div class="panel-group pl-3 pb-2">
                <a v-bind:href="'/classified/'+ this.classified.id">
                    <h5 style="color: blue">{{classified.name}}</h5>
                </a>
                <div class="panel panel-default pb-4">
                    <div class="panel-body">
                        Tu pregunta: {{question.buyer_question}}
                    </div>
                    <div v-if="mode == 'received'">
                        <replies-form @replied = "relayEmit()"
                                      :question_id = "this.question.id"
                        >
                        </replies-form>
                    </div>
                    <div v-else>
                        <div class="panel-body d-flex" v-if="question.seller_reply != ''">
                            <p>Respuesta del vendedor: {{question.seller_reply}}</p>
                            <p class="ml-2">{{question.updated_at}}</p>
                        </div>
                        <div v-else>
                            Esperando respuesta del vendedor...
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    </div>
</template>

<script>
    export default {
        name: "QuestionsPanel",
        props:['question', 'mode'],
        data() {
            return {
                classified: {
                    id : '',
                    name : '',
                    price : '',
                    image : '',
                }
            }
        },

        methods: {
            relayEmit() {
                this.$emit("replied");
            },

            getImgUrl(pic){
                return ('/storage/uploads/'+pic)
            }
        },

        mounted() {
            axios.get(`/articleinfo/${this.question.id}`).then((response)=>{
                this.classified = response.data;
            });
        }
    }
</script>

<style scoped>

</style>
