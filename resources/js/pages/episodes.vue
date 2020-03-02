<template>
<div>
<v-toolbar dark color="elavation-2" dense class="mb-2">
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

  <v-simple-table >
    <template v-slot:default>
      <thead>
        <tr>
          <th class="text-left">EP Name</th>
          <th class="text-left">EP</th>
          <th class="text-left">Label</th>
          <th class="text-left">Last Update</th>
          <th class="text-left">Status</th>
          <th class="text-left">Show</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in episodes" :key="item.id">
          <td>{{ item.name }}</td>
          <td>{{ item.ep }}</td>
          <td>{{ item.label }}</td>
          <td>{{ item.updated_at }}</td>
          <td>
          	<v-chip label :color="getColorStatus(item)" small dark>{{ item.status }}</v-chip>
          </td>
          <td>
          	<v-icon v-if="item.show">mdi-eye</v-icon>
          	<v-icon v-else>mdi-eye-off</v-icon>
        	</td>
        </tr>
      </tbody>
    </template>
  </v-simple-table>

  <form-loading :loading="loading"></form-loading>
</div>
</template>


<script>
import axios from 'axios'
import FormLoading from '../components/loading.vue'
export default {
  components: { FormLoading },
  data () {
    return {
      episodes: [],
      shows: [20, 40, 60, 80],
      query: {
        keyword: null,
        show: 20
      },
      loading: false
    }
  },
  watch: {
    'query.keyword' () { this.getEpisodes() },
    'query.show' () { this.getEpisodes() }
  },
  created () {
  	this.getEpisodes()
  },
  methods: {
  	getColorStatus(ep) {
			if (ep.status == 'uploaded') return 'green'
			if (ep.status == 'uploading') return 'orange'
			if (ep.status == 'error') return 'red'
		},
    getEpisodes () {
      this.loading = true
      setTimeout(() => {
        axios.get('/all-episodes', { params: this.query })
        .then(res => {
          this.episodes = res.data
          this.loading = false
        })
      }, 300)
      
    }
  }
}
</script>