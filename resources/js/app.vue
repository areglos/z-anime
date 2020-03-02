<template>
<v-app dark>
    <v-navigation-drawer v-model="drawer" fixed app >
      <v-list-item>
        <v-list-item-content>
          <v-list-item-title class="title text-capitalize">
            {{ me.name }}
          </v-list-item-title>
          <v-list-item-subtitle>
            {{ me.email }} | {{ me.role }}
          </v-list-item-subtitle>
        </v-list-item-content>
      </v-list-item>

      <v-divider></v-divider>

      <v-list>
        <v-list-item 
          v-for="(item, i) in menus"
          :key="i"
          :to="item.to"
          v-if="hasRole(item.role)"
          router
          exact
        >
          <v-list-item-action>
            <v-icon>{{ item.icon }}</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title v-text="item.title" />
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
    <v-app-bar
      fixed
      app
    > 
      <v-app-bar-nav-icon @click.stop="drawer = !drawer" />
      <v-toolbar-title v-text="title" />
      <v-spacer></v-spacer>
      <v-btn icon href="/logout">
        <v-icon>mdi-account-arrow-right-outline</v-icon>
      </v-btn>
    </v-app-bar>
    <v-content>
      <v-container fluid>
        <router-view></router-view>
      </v-container>
    </v-content>

    <!-- Notify -->
    <v-snackbar v-model="snackbar.show" :timeout="4000" :color="snackbar.color">
      {{ snackbar.text }}
    </v-snackbar>
    <!-- Loading -->
    
  </v-app>
</template>

<script>
import axios from 'axios'
export default {
  data () {
    return { 
      drawer: true,
      menus: [
        
        { icon: 'mdi-view-dashboard', title: 'Dashboard', to: '/', role:'manager' },
        { icon: 'mdi-apps', title: 'Film', to: '/films', role:'manager' },
        { icon: 'mdi-expand-all', title: 'Episode', to: '/episodes', role: 'manager' },
        { icon: 'mdi-format-list-bulleted-square', title: 'Category', to: '/categories', role: 'manager' },
        { icon: 'mdi-format-list-text', title: 'Type', to: '/types', role: 'manager' },

        { icon: 'mdi-account-details', title: 'User', to: '/users', role: 'admin' },
        { icon: 'mdi-math-log', title: 'Logs', to: '/logs', role: 'admin' },
        { icon: 'mdi-cogs', title: 'Settings', to: '/settings', role: 'admin' },
      ],
      me: {},
      snackbar: {},
      title: 'Vuetify.js',
      loading: true,
    }
  },
  created () {
    axios.get('/me').then(res => this.me = res.data )

    this.$bus.$on('snackbar', (snackbar) => {
      snackbar.show = true
      snackbar.color = snackbar.color || 'success'
      snackbar.text = snackbar.text
      this.snackbar = snackbar
    })
  },
  methods: {
    hasRole(role) {
      if (this.me.role == 'admin' || this.me.role == role) return true;
      return false;
    }
  }
}
</script>
