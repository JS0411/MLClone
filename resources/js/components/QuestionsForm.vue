<template>
    <div>
        <form @submit.prevent="newQuestion()">
            <div class="form-group">
                <div class="d-flex">
                    <textarea
                        class="form-control"
                        id="questionText"
                        v-model="buyer_question"
                        rows="2"
                        placeholder="Escribe una pregunta..."
                        required>
                    </textarea>

                    <button class="btn btn-primary ml-2" >Enviar Pregunta</button>
                </div>
            </div>
        </form>
        <transition name="fade">
            <div v-if="this.alertList[0] != undefined && this.alertList[0].text!=''"> <!--If the alert isnt empty and isnt the default, we show it-->
                <div v-for="(alert, index) in alertList" :key="index">
                    <div class="alert text-center" :class="{'alert-success':alert.success,'alert-danger':!alert.success }" @click="popAlert(index);">
                        <strong>{{alert.text}}.</strong>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
    export default {

        data() {
            return {
                buyer_question:'',
                alertList: [{
                    text: '',
                    success: true,
                }]
            }
        },
        props:['classified_id'],
        methods: {
            newQuestion() {
                //VERIFICAR QUE LA RESPUESTA NO SEA DE <6 CARACTERES
                if (this.buyer_question.length < 6){
                    this.pushAlert('Su pregunta no puede ser de menos de 6 caracteres...', false);
                } else {
                    const params = {
                        buyer_question: this.buyer_question,
                        classified_id : this.classified_id,
                    }
                    axios.post('/questions', params).then((response) => {
                        const question = response.data;
                        this.$emit('new', question);
                        this.pushAlert('Su pregunta ha sido enviada exitosamente', true);
                    }).catch(error => {
                        this.pushAlert(error, false);
                    });
                }
                this.buyer_question = '';
            },

            pushAlert(message, status){
                //If the error is still the default and not undefined, replace by the message's text
                if (this.alertList[0] != undefined && this.alertList[0].text == ''){
                    this.alertList[0].text = message;
                    this.alertList[0].success = status;
                } else {
                    this.alertList.push({
                        'text': message,
                        'success': status,
                    })
                }

            },

            popAlert(index){
                this.alertList.splice(index,1);
            },
        },
    }
</script>

<style scoped>

    .alert {
        position: fixed;
        z-index: 3;
        bottom: 0px;
    }

    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }
    .fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
        opacity: 0;
    }

</style>
