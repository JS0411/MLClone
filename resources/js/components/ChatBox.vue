<template>
    <div class="container">
        <div class="chat-panel" id="chat_panel">
            <p class="text-center pt-2 pb-2 background">No compartas informacion acerca de tu cuenta con otros
                usuarios...</p>
            <p v-if="Object.keys(this.messages).length == 0" class="text-center">Nadie ha enviado un mensaje todavia, se
                el primero!</p>
            <div
                v-else
                v-for="(message,index) in messages" :key="message.index">
                <div class="row no-gutters" v-if="message.sender == mode">
                    <!--If the received messages are from the reader, they're shown to the right-->
                    <div class="col-md-6 offset-md-6">
                        <div class="chat-bubble chat-bubble--right right text-break">
                            <p class="mb-1">{{message.message}}</p>
                            <span class="small date">{{message.created_at}}</span>
                        </div>
                    </div>
                </div>
                <!--Else, they're shown to the left-->
                <div class="row no-gutters" v-else>
                    <div class="col-md-6">
                        <div class="chat-bubble chat-bubble--left text-break">
                            <p class="mb-1">{{message.message}}</p>
                            <span class="small date">{{message.created_at}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="input" v-if="active == true">
            <chat-form
                :purchase_id="purchase_id"
                :mode="mode"
                @replied="addMessage">
            </chat-form>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ChatBox",

        props: ['purchase_id', 'mode', 'active'],

        data() {
            return {
                messages: {
                    message: '',
                    sender: '',
                    created_at: '',
                },
            }
        },

        methods: {
            addMessage(message) {
                this.messages.push(message);
            },

            scrollToEnd() {
                this.$nextTick(() => {
                    const element = this.$el.querySelector(".chat-panel");
                    element.scrollIntoView({block: "end"});
                });

            }
        },

        mounted() {
            const params = {
                purchase_id: this.purchase_id,
            }
            axios.get('/messages', {params}).then((response) => {
                this.messages = response.data;
            });
        },


        updated() {
            this.scrollToEnd();
        }

    }
</script>

<style scoped>

    .container {
        background-color: rgba(233, 226, 210, 0.64);
        border-style: groove;
        border-color: black;
        border-radius: 10px;
        padding-left: 0px;
        padding-right: 0px;
        max-height: 500px;
        overflow: scroll;
        overflow-x: hidden;
    }

    .chat-panel {
        padding-bottom: 100px;
    }

    .chat-bubble {
        max-width: 100%;
        padding: 10px 14px 20px 14px;
        background: #fff;
        margin: 10px 30px;
        border-radius: 9px;
        position: relative;
        animation: fadeIn 1s ease-in;

    }

    .chat-bubble::after {
        content: '';
        position: absolute;
        top: 50%;
        width: 0;
        height: 0;
        border: 20px solid transparent;
        border-bottom: 0;
        margin-top: -10px;
    }

    .chat-bubble--left::after {
        left: 0;
        border-right-color: #fff;
        border-left: 0;
        margin-left: -20px;
    }


    .chat-bubble--right::after {
        right: 0;
        border-left-color: #74b9ff;
        border-right: 0;
        margin-right: -20px;
    }

    .right {
        color: #fff;
        background-color: #74b9ff;
    }

    .date {
        font-size: 12px;
        float: right;
    }

    .background {
        background-color: #74b9ff;
        color: white;
        position: sticky;
        top: 0px;
        z-index: 2;
    }

    .input {
        position: sticky;
        bottom: 0px;
        z-index: 2;
    }

</style>
