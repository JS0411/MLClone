<template>
    <div>
        <form @submit.prevent="replyQuestion()">
            <div class="form-group">
                <div class="d-flex">
                    <textarea class="form-control" id="replyText"
                              v-model="seller_reply"
                              rows="2"
                              placeholder="Escribe tu respuesta..."
                              required>
                    </textarea>
                    <button class="btn btn-primary ml-2" >Enviar Respuesta</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        props: ['question_id'],
        data() {
            return {
                seller_reply:'',
            }
        },
        methods: {
            replyQuestion() {
                const params = {
                    seller_reply: this.seller_reply,
                }
                axios.put(`/questions/${this.question_id}`, params).then((response) => {
                    this.$emit('replied');
                });
            }
        },
    }
</script>

<style scoped>

</style>
