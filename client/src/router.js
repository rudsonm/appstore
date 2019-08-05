import Vue from 'vue'
import VueRouter from 'vue-router'

import AppModuloLista from './views/AppModuloLista.vue'
import AppModuloDetalhes from './views/AppModuloDetalhes.vue'

Vue.use(VueRouter)

export default new VueRouter({
  mode: 'history',
  routes: [
    { path: '/modulos', component: AppModuloLista },
    { path: '/modulos/:id', component: AppModuloDetalhes },
    { path: '/', redirect: 'modulos' }
  ]
})