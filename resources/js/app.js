
require('./bootstrap');

window.Vue = require('vue').default;

Vue.component('examplecomponent', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data :
        {
            text1 : 'vue js test text'
        }
});
