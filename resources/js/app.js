import axios from 'axios'
axios.defaults.baseURL = window.BASE_URL+'api/admin';
axios.defaults.headers.common = {
    'X-CSRF-TOKEN': window.CSRF_TOKEN,
    'X-Requested-With': 'XMLHttpRequest'
};


import Vue from 'vue'
import Router from './router.js'
import vuetify from './vuetify.js'
import App from './app.vue'

const EventBus = new Vue()
Vue.prototype.$bus = EventBus
Vue.prototype.$url = (path) => {
	return window.BASE_URL+path
}

const app = new Vue({
    el: '#app',
    render:h => h(App),
    vuetify,
    router: Router,
    data () {
    	return { 
    		drawer: true,
	      menus: [
	        {
	          icon: 'mdi-apps',
	          title: 'Film',
	          to: '/films'
	        },
	        {
	          icon: 'mdi-video-vintage',
	          title: 'Episode',
	          to: '/episodes'
	        },
	      ],
	      title: 'Vuetify.js',
    	}
    },
});
