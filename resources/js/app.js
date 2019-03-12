
require('./bootstrap');

window.Vue = require('vue');
import moment from 'moment';
import { Form, HasError, AlertError } from 'vform'
import VueRouter from 'vue-router'
import VueProgressBar from 'vue-progressbar'

import Inputmask from 'inputmask'

import Gate from './Gate'

Vue.prototype.$gate = new Gate( window.user );

import swal from 'sweetalert2'
window.swal = swal;

const toast = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});

const unidades = {
    'F': {
        '10' : 'Gato do Mato',
        '11' : 'Jaguatirica',
        '12' : 'Lince',
        '13' : 'Suçuarana',
        '14' : 'Onça Pintada',
        '15' : 'Tigre'
    },
    'M': {
        '10' : 'Jaguar',
        '11' : 'Pantera Negra',
        '12' : 'Guepardo',
        '13' : 'Leopardo das Neves',
        '14' : 'Puma',
        '15' : 'Leão'
    }
};

window.unidades = unidades;

window.toast = toast;

window.Form = Form;

window.Fire = new Vue();

Vue.use( Inputmask )
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
    'tabela-membros',
    require('./components/TabelaMembros.vue').default
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
    'inscricao-responsaveis',
    require('./components/preInscricao/Responsaveis.vue').default
);

Vue.component(
    'contatos',
    require('./components/Contatos.vue').default
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue').default
);

let routes = [
    { path: '/preInscricao', component: require('./components/PreInscricao.vue').default },
    { path: '/adicionarMembro', component: require('./components/preInscricao/AdicionarMembro.vue').default },
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

Vue.filter( 'descricaoParentesco', function ( parentesco ) {
    switch( parentesco ) {
        case "pai": return 'Pai';
        case "mae": return "M\u00E3e";
        case "a_avo": return 'Av\u00F3';
        case "o_avo": return 'Av\u00F4';
        case "tio": return 'Tio';
        case "tia": return 'Tia';
        case "padastro": return 'Padastro';
        case "madastra": return 'Madastra';
        default: return 'Outros';
    }

})

Vue.filter( 'situacaoDesbravador', function ( sit ) {
    let situacao = 'Incompleta';

    switch ( sit ) {
        case '':

    }

    return sit;
} );

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
    router
});
