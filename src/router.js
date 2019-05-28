import Vue from 'vue'
import Router from 'vue-router'
import Home from './views/Home.vue'
import Contact from './views/Contact.vue'
import Inicio from './views/Inicio-session.vue'
import ListaNota from './views/Lista-nota.vue'
import Nota from './views/Nota.vue'
import Registrar from './views/Registrar.vue'

Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home
    },
    {
      path: '/contact',
      name: 'contact',
      component: Contact
    },
    {
      path: '/inicio-session',
      name: 'inicio',
      component: Inicio
    },
    {
      path: '/lista',
      name: 'lista-nota',
      component: ListaNota
    },
    {
      path: '/nota',
      name: 'nota',
      component: Nota
    },
    {
      path: '/registro',
      name: 'registro',
      component: Registrar
    },
    // {
    //   path: '/about',
    //   name: 'about',
    //   // route level code-splitting
    //   // this generates a separate chunk (about.[hash].js) for this route
    //   // which is lazy-loaded when the route is visited.
    //   component: () => import(/* webpackChunkName: "about" */ './views/About.vue')
    // }
  ]
})
