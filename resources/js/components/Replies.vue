<template>
    <div>
        <p v-if="Object.keys(this.questions).length == 0" class="text-center">No has {{placeholderText}}</p>
        <replies-panel
            v-else
            v-for="(question,index) in questions"
            :key="question.id"
            :question="question"
            :mode="mode"
            @replied="removeQuestion(index)"
        ></replies-panel>
    </div>
</template>

<script>
    export default {
        props:['question_ids', 'mode'],

        data() {
            return {
                questions: [],
                placeholderText : '',
            }
        },

        mounted() {
            const params = {
                id: this.question_ids,
                id_setting: 'question' //This will use the question_id's in order to fetch the questions we need.
            }
            axios.get('/questions', {params}).then((response)=>{
               this.questions = response.data;
            }).catch(error => {
            });
            if (this.mode == 'received'){
                this.placeholderText = 'recibido preguntas todavia, vuelve mas tarde a ver!';
            } else if (this.mode == 'asked'){
                this.placeholderText = 'hecho preguntas todavia, has una y aparecera aqui!';
            }
        },

        methods: {
            removeQuestion(index) {
                this.questions.splice(index,1);
            }
        },
    }
</script>

<style scoped>
.panel-group{
}
</style>

