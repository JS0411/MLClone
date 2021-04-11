<template>

</template>

<script>
    import { createWidgetMixin } from 'vue-instantsearch';
    import { connectSearchBox } from 'instantsearch.js/es/connectors';

    export default {
        mixins: [createWidgetMixin({ connector: connectSearchBox })],
        render() {
            return null;
        },
    };
</script>

<style scoped>

</style>
