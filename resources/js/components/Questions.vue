<template>
    <div>
        <h3>Preguntas y respuestas</h3>
        <questions-form v-if="active == true && reader_id != owner_id && reader_id != 0" @new="addQuestion" :classified_id = "this.classified_id"></questions-form>
        <p v-if="Object.keys(this.questions).length == 0" class="text-center">No hay preguntas todavia, realiza una o vuelve mas tarde a ver!</p>
        <questions-panel
            v-else
            v-for="question in questions"
            :key="question.id"
            :question="question"
        ></questions-panel>
    </div>
</template>

<script>
    export default {
        props:['classified_id', 'active', 'reader_id', 'owner_id'],

        data() {
            return {
                questions: [],
            }
        },

        mounted() {
            const params = {
                id: this.classified_id,
                id_setting: 'classified' //This will use the classified's id in order to fetch the questions we need.
            }
            axios.get('/questions', {params}).then((response)=>{
               this.questions = response.data;
               this.questions.sort((a,b) => {
                    return b.id-a.id
                });
            });
        },

        methods: {
            addQuestion(question) {
                this.questions.unshift(question);
            }
        },
    }
</script>

<style scoped>
.panel-group{
}
</style>

