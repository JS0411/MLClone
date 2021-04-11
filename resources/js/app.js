/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


require('./bootstrap');

window.Vue = require('vue');
import VueInstantSearch from "vue-instantsearch";
import VuePaginate from 'vue-paginate'
/*REMOVE THIS AND IMPORT EACH COMPONENT INDIVIDUALLY ON CLASSIFIED HANDLERS*/
Vue.use(VueInstantSearch);
Vue.use(VuePaginate);
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('questions-section', require('./components/Questions.vue').default);
Vue.component('questions-form', require('./components/QuestionsForm.vue').default);
Vue.component('questions-panel', require('./components/QuestionsPanel.vue').default);
Vue.component('replies-section', require('./components/Replies.vue').default);
Vue.component('replies-form', require('./components/RepliesForm.vue').default);
Vue.component('replies-panel', require('./components/RepliesPanel.vue').default);
Vue.component('purchase-button', require('./components/PurchaseButton.vue').default);
Vue.component('favorite-button', require('./components/FavoriteButton.vue').default);
Vue.component('chat-box', require('./components/ChatBox.vue').default);
Vue.component('chat-form', require('./components/ChatForm.vue').default);
Vue.component('classifieds-search', require('./components/ClassifiedsSearch.vue').default);
Vue.component('myclassifieds-search', require('./components/MyClassifiedsSearch.vue').default);
Vue.component('mypurchases-search', require('./components/MyPurchasesSearch.vue').default);
// C:/Users/JOSE/Downloads/MLClone/node_modules/vue-instantsearch/src
Vue.component('classifieds-refinement', require('./components/ClassifiedsRefinementList.vue').default);
Vue.component('virtual-searchbox', require('./components/VirtualSearchBox.vue').default);
Vue.component('reputations', require('./components/Reputations.vue').default);
Vue.component('reputations-filter', require('./components/ReputationsFilter.vue').default);
Vue.component('reputations-box', require('./components/ReputationsBox.vue').default);
Vue.component('draggable-menu', require('./components/DraggableMenu.vue').default);
Vue.component('edit-menu', require('./components/EditMenu.vue').default);
Vue.component('create-menu', require('./components/CreateMenu.vue').default);
Vue.component('classified-success', require('./components/ClassifiedSuccess.vue').default);
Vue.component('purchase-success', require('./components/PurchaseSuccess.vue').default);
Vue.component('classified-gallery', require('./components/ClassifiedGallery.vue').default);
Vue.component('hits-connector', require('./components/HitsConnector.vue').default);
Vue.component('refresh-connector', require('./components/RefreshConnector.vue').default);
Vue.component('image-gallery', require('./components/ImageGallery.vue').default);
Vue.component('reputation-gradient',require('./components/ReputationGradient.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#main',
});
