<template>
</template>

<script>
    import { createWidgetMixin } from 'vue-instantsearch';

    const connectRefresh = (renderFn, unmountFn) => (widgetParams = {}) => ({
        init() {
            renderFn({ refresh() {} }, true);
        },

        render({ instantSearchInstance }) {
            const refresh = instantSearchInstance.refresh.bind(instantSearchInstance);

            renderFn({ refresh }, false);
        },

        dispose() {
            unmountFn();
        },
    });

    export default {
        name: 'AisStateResults',
        props:['triggerUpdate'],
        mixins: [createWidgetMixin({ connector: connectRefresh })],
        watch: {
            triggerUpdate: function(){
                if (this.triggerUpdate == true) {
                    this.state.refresh();
                    this.$emit('refreshFlag')
                }
            }
        },


    };
</script>
