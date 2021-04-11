<template>
    <div class="panel-group pt-2 pb-2">
        <div class="panel panel-default pb-4">
            <div class="panel-body">
                {{question.buyer_question}}
            </div>
            <div class="panel-body pt-2" v-if="question.seller_reply">
                {{question.seller_reply}}
                <small class="text-muted pl-1">{{question.created_at}}</small>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "QuestionsPanel",
        props:['question'],
        data() {
            return {

            }
        },
    }
</script>

<style scoped>

</style>
