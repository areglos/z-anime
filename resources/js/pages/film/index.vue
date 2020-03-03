<template>
<div>
<v-toolbar dark color="elavation-2" dense class="mb-2">
  <v-btn color="primary" class="mr-3" @click="dialog=true">Add film</v-btn>
  <v-text-field
    class="mr-3"
    hide-details
    placeholder="Search"
    width="100"
    append-icon="mdi-magnify"
    single-line
    v-model="query.keyword"
    style="max-width:400px"
  ></v-text-field>
  <v-select
    class="mr-3"
    hide-details
    :items="shows"
    v-model="query.show"
    placeholder="Show"
    single-line
    style="max-width:150px"
  ></v-select>
</v-toolbar>

<v-row dense>
  <v-col v-for="(film,index) in films" :key="film.id" lg="3" md="4" sm="6">
    <v-card class="mb-2">
      <v-img 
        :src="$url(film.background)" 
        class="white--text align-end"
        gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.3)"
        height="180px"
      >
        <v-card-title v-text="film.name"></v-card-title>
      </v-img>

      <v-card-actions>
        <div class="caption">
          <v-icon>mdi-heart</v-icon>
          <span class="mr-2">256</span>
        </div>
        <div class="caption">
          <v-icon>mdi-comment</v-icon>
          <span class="mr-2">256</span>
        </div>
        <div class="caption">
          <v-icon>mdi-eye</v-icon>
          <span class="mr-2">256</span>
        </div>
        <v-spacer></v-spacer>
        <v-btn icon :to="{name:'Film.episodes', params:{id:film.id} }">
        	<v-icon>mdi-plus</v-icon>
        </v-btn>
        <v-btn icon :to="{name: 'Film.edit', params: { id: film.id } }">
        	<v-icon>mdi-pencil</v-icon>
        </v-btn>
        <v-btn icon @click="deleteFilm(index,film.id)">
        	<v-icon>mdi-delete</v-icon>
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-col>
</v-row>

<v-dialog v-model="dialog" max-width="500">
  <v-card>
    <v-card-title>Add new film</v-card-title>
    <v-divider></v-divider>
    <v-card-text>
      <v-text-field label="Film Name" v-model="newFilmName" @keyup.enter="createFilm" />
    </v-card-text>
    <v-divider></v-divider>
    <v-card-actions>
      <v-spacer></v-spacer>
      <v-btn color="primary" @click="createFilm">Add</v-btn>
    </v-card-actions >
  </v-card>
</v-dialog>
<form-loading :loading="loading"></form-loading>
</div>
</template>

<script>
import axios from 'axios'
import FormLoading from '../../components/loading.vue'
export default {
  components: { FormLoading },
  data () {
  	return {
  		dialog: false,
      films: [],
      shows: [20, 40, 60, 80],
      query: {
        keyword: null,
        show: 20
      },
      loading: false,
      newFilmName: 'The Seven Deadly Sins'
  	}
  },
  watch: {
    'query.keyword' () { this.getFilms() },
    'query.show' () { this.getFilms() }
  },
  created () {
    this.getFilms()
  },
  methods: {
    createFilm() {
      axios.post('/films', { name: this.newFilmName })
      .then(res => {
        this.$router.push({ name:'Film.edit', params: {id:res.data.id} })
      })
    },
    getFilms () {
      this.loading = true
      setTimeout(() => {
        axios.get('/films', { params: this.query })
          .then(res => {
            this.films = res.data
            this.loading = false
          })
        },300)
    },
    deleteFilm(index, id) {
      if(confirm('Confirm delete film')) {
        axios.delete('/films/'+id)
        .then(res => {
          this.films.splice(index,1)
          this.$bus.$emit('snackbar', { text: 'Delete successful' })
        })
        .catch(err => {})
      }
    }
  }
}
</script>