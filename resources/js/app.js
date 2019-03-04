
require('./bootstrap');

window.Vue = require('vue');
import moment from 'moment';
import { Form, HasError, AlertError } from 'vform'
import VueRouter from 'vue-router'
import VueProgressBar from 'vue-progressbar'

import swal from 'sweetalert2'
window.swal = swal;

const toast = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});

window.toast = toast;

window.Form = Form;

window.Fire = new Vue();

Vue.use(VueRouter)
Vue.use( VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '2px'
} )

Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue').default
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue').default
);

let routes = [
    { path: '/preInscricao', component: require('./components/PreInscricao.vue').default },
    { path: '/boasVindas', component: require('./components/BoasVindas.vue').default },
    { path: '/developer', component: require('./components/Developer.vue').default },
    { path: '/dashboard', component: require('./components/Dashboard.vue').default },
    { path: '/users', component: require('./components/Users.vue').default },
    { path: '/profile', component: require('./components/Profile.vue').default }
]

const router = new VueRouter({
    mode: 'history',
    routes
})

Vue.filter( 'upText', function( text ){
    return text.charAt(0).toUpperCase() + text.slice(1).toLowerCase();
});

Vue.filter( 'myDate', function( created ){
    return moment( created ).format('MMMM Do YYYY');
});

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
    router
});
