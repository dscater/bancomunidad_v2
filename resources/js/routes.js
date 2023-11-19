import Vue from 'vue';
import Router from 'vue-router';

Vue.use(Router);

export default new Router({
    routes: [
        // INICIO
        {
            path: '/',
            name: 'inicio',
            component: require('./components/Inicio.vue').default
        },

        // LOGIN
        {
            path: '/login',
            name: 'login',
            component: require('./Auth.vue').default
        },

        // FUNCIONARIOS
        {
            path: '/funcionarios',
            name: 'funcionarios.index',
            component: require('./components/modulos/funcionarios/index.vue').default
        },

        // AGENCIAS
        {
            path: '/agencias',
            name: 'agencias.index',
            component: require('./components/modulos/agencias/index.vue').default
        },

        // REGIONAL
        {
            path: '/regionals',
            name: 'regionals.index',
            component: require('./components/modulos/regionals/index.vue').default
        },

        // CARGOS
        {
            path: '/cargos',
            name: 'cargos.index',
            component: require('./components/modulos/cargos/index.vue').default
        },

        // SISTEMAS
        {
            path: '/sistemas',
            name: 'sistemas.index',
            component: require('./components/modulos/sistemas/index.vue').default
        },

        // PERFIL SISTEMAS
        {
            path: '/perfil_sistemas',
            name: 'perfil_sistemas.index',
            component: require('./components/modulos/perfil_sistemas/index.vue').default
        },

        // ASIGNACIONS
        {
            path: '/asignacions',
            name: 'asignacions.index',
            component: require('./components/modulos/asignacions/index.vue').default
        },

        // CONTROL
        {
            path: '/controls',
            name: 'controls.index',
            component: require('./components/modulos/controls/index.vue').default
        },

        // ACCESO SISTEMA
        {
            path: '/acceso_sistemas',
            name: 'acceso_sistemas.index',
            component: require('./components/modulos/acceso_sistemas/index.vue').default
        },

        // FORMULARIOS
        {
            path: '/formularios',
            name: 'formularios.index',
            component: require('./components/modulos/formularios/index.vue').default
        },

        // REPORTES
        {
            path: '/reportes/funcionario_sistemas',
            name: 'reportes.funcionario_sistemas',
            component: require('./components/modulos/reportes/funcionario_sistemas.vue').default,
            props: true
        },
        // PÁGINA NO ENCONTRADA
        {
            path: '*',
            component: require('./components/modulos/errors/404.vue').default
        },
    ],
    mode: 'history',
    linkActiveClass: 'active'
});