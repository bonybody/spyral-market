/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */


Vue.component('user-register-component', require('./components/welcomes/userRegister.vue').default);
Vue.component('home-categories-component', require('./components/homes/homes').default);
Vue.component('put-up-tags-component', require('./components/homes/put_up/sub/item_tag').default);
Vue.component('users-edit-subjects-components', require('./components/homes/users_edit/subjects').default);
import Multiselect from 'vue-multiselect';
Vue.component('multiselect', Multiselect);
Vue.component('put-up-dialog-component', require('./components/homes/put_up/sub/put_up_check_dialog').default);
Vue.component('put-up-item-category', require('./components/homes/put_up/sub/item_category').default);
Vue.component('PutUpComponent', require('./components/homes/put_up/PutUpComponent').default);
Vue.component('BuyItemCheckComponent', require('./components/homes/items/sub/BuyItemCheckComponent').default);
Vue.component('ChatRoomListComponent', require('./components/homes/chat/chat/chat').default);
Vue.component('ChatRoomComponent', require('./components/homes/chat/chat_room/chat_room').default);
Vue.component('my-item-index', require('./components/homes/my-item/index/my-item-index').default);
Vue.component('my-item-delete-main', require('./components/homes/my-item/delete/my-item-delete-main').default);
const app = new Vue({
    el: '#app',
});


