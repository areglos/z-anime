import Vue from 'vue'
import VueRouter from 'vue-router'

import Dashboard from './pages/dashboard.vue'
import FilmIndex from './pages/film/index'
import FilmEdit from './pages/film/edit'
import FilmEpisode from './pages/film/episodes'
import Episodes from './pages/episodes' // all episodes and status !
import Categories from './pages/categories'
import Types from './pages/types'
Vue.use(VueRouter)

const router = new VueRouter({
	base: '/admin',
	mode: 'history',
	routes:[
		{ path:'/', name:'Dashboard', component: Dashboard },
		{ path:'/films', name:'Film.index', component: FilmIndex },
		{ path:'/films/:id/edit', name: 'Film.edit', component: FilmEdit },
		{ path:'/films/:id/episodes', name: 'Film.episodes', component: FilmEpisode },
		{ path:'/episodes', name: 'Episode.all', component: Episodes },
		{ path:'/categories', name: 'Categories', component: Categories },
		{ path:'/types', name: 'Types', component: Types },
	]


})

export default router
