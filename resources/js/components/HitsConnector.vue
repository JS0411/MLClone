<template>

</template>

<script>
    import { createWidgetMixin } from 'vue-instantsearch';
    import { connectHits } from 'instantsearch.js/es/connectors';
    export default {
        mixins: [
            createWidgetMixin({ connector: connectHits })
        ],

        mounted(){
            this.unwatchHits = this.$watch('state', (newVal) => {
                if (newVal){
                    this.$emit('loaded');
                    this.unwatchHits();
                }
            });
        },

        dispose() {
            unmountFn();
        },

    };
</script>

<style scoped>

</style>
