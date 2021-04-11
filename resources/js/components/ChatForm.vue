<template>
    <div>
        <form @submit.prevent="sendMessage()">
            <div class="row no gutters">
                <div class="col-md-11 pr-0">
                <textarea class="form-control no-focusborder" id="messageText"
                          v-model="message"
                          rows="2"
                          placeholder="Escribe tu mensaje..."
                          required>
                </textarea>
                </div>
                <div class="col-md-1 pl-0">
                    <button class="btn btn-primary"><i class="fa fa-paper-plane"></i></button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        props: ['purchase_id', 'mode'],
        data() {
            return {
                message:'',
            }
        },
        methods: {
            sendMessage() {
                const params = {
                    message : this.message,
                    purchase_id : this.purchase_id,
                    mode : this.mode,
                }
                axios.post(`/messages`, params).then((response) => {
                    const message = response.data
                    this.$emit('replied', message);
                });
                this.message='';
            }
        },
    }
</script>

<style scoped>
    /*This was put here due to form-control having a border radius, so it doesnt line up with the other border nor cover the button.*/
    form {
        border-top: 3px solid black;
    }

    .form-control {
        resize: none;
        border-color: transparent;
        border-radius: 0px;
    }

    .no-focusborder:focus {
        outline-style: none;
        box-shadow: none;

    }

    button{
        border-radius:0px;
        width:100%;
        height:100%;
    }
</style>
