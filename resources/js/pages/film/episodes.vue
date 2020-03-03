<template>
<div>
	<v-row justify="center">
		<v-col sm="8">
			<v-card class="elavation-6 mb-4">
				<v-card-title>{{ film.name }}</v-card-title>
				<v-divider></v-divider>
				<v-card-text class="px-3 py-0">
					<v-row>
						<v-col sm="3">
							<v-img :src="$url(film.image)" height="300px"></v-img>
						</v-col>
						<v-col sm="9">
							<v-img :src="$url(film.background)" height="300px"></v-img>
						</v-col>
					</v-row>
				</v-card-text>
			</v-card>

			<v-card class="elevation-6 mb-4">
				<v-card-title>Episodes</v-card-title>
				<v-divider></v-divider>
				<v-card-text>

					<v-chip 
						v-for="(ep, idx) in film.episodes" :key="ep.id" 
						:color="getColor(ep)" label link class="mr-1" @click="openEpisodeForm(ep)">
					{{ ep.label ? ep.label : ep.ep }}
					</v-chip><v-chip label link @click="openEpisodeForm()">+</v-chip>
				</v-card-text>
			</v-card>



			<v-card class="elevation-6" v-if="episodeForm">
				<v-card-title>{{ this.episode.id ? 'Edit episode' : 'Add new episode' }}
				</v-card-title>
				<v-divider></v-divider>
				<v-card-text>
					<v-text-field label="EP Name" v-model="episode.name"></v-text-field>
					<v-row>
						<v-col sm="4">
							<v-text-field label="EP" v-model="episode.ep"></v-text-field>
						</v-col>	
						<v-col sm="4">
							<v-text-field label="EP Label" v-model="episode.label"></v-text-field>
						</v-col>
					</v-row>
					<v-text-field label="Drive ID" v-model="episode.drive" ></v-text-field>
				</v-card-text>

				<v-card-actions>
					<v-btn color="primary" @click="$router.back()">
	        	Back
	        </v-btn>
	        <v-spacer />
	        <v-btn color="red" @click="removeEpisode()" v-if="this.episode.id">
	        	Delete
	        </v-btn>
	        <v-btn color="primary" @click="submitEpisodeForm()">
	        	{{ this.episode.id ? 'Update' : 'Add' }}
	        </v-btn>
	        
	      </v-card-actions>
			</v-card>


		</v-col>

	</v-row>
	<form-loading :loading="loading"></form-loading>
</div>

</template>


<script>
import axios from 'axios'
import FormLoading from '../../components/loading'
export default {
	components: { FormLoading },
	data () {
		return {
			film: {},
			episode: {},
			episodeForm: false,
			index: null,
			loading:false,
		}
	},
	async created () {
		this.loading = true
		try {
			this.film = (await axios.get('/films/' + this.$route.params.id +'/episodes')).data
		}
		catch (err) {
			this.$bus.$emit('snackbar', { color:'error', text:err.response.data.error })
		}
		this.loading = false
	},
	methods: {
		getColor(ep) {
			if (this.episode.id == ep.id) return 'blue'
			if (ep.status == 'uploaded') return 'green'
			if (ep.status == 'uploading') return 'orange'
			if (ep.status == 'error') return 'red'
		},
		openEpisodeForm(ep = {}) {
			this.episode = ep
			this.episodeForm = true
		},
		async submitEpisodeForm() {
			this.loading = true
			try {
				if (!this.episode.id) {
					let ep = (await axios.post('/films/'+this.film.id+'/episodes', this.episode)).data
					this.film.episodes.push(ep)
					this.$bus.$emit('snackbar', { text: 'Create Successful' })
				}
				else {
					let film = (await axios.put('/films/'+this.film.id+'/episodes/'+this.episode.id, this.episode)).data
					const index = this.film.episodes.indexOf(this.episode)
					console.log(index)
					this.film.episodes.splice(index,1,film) 
					this.$bus.$emit('snackbar', { text: 'Update Successful' })
				}
				this.episodeForm = false
			}
			catch (err) {
				this.$bus.$emit('snackbar', { color:'error', text: err.response.data.error })
			}
			this.loading = false
		},
		async removeEpisode() {
			if(confirm('Confirm delete episode')) {
				this.loading = false
				try {
					await axios.delete('/films/'+this.film.id+'/episodes/'+this.episode.id)
					this.episodeForm = false
          this.film.episodes.splice(this.index,1)
          this.$bus.$emit('snackbar', { text: 'Delete successful' })
				}
				catch (err) {
					this.$bus.$emit('snackbar', { color:'error', text: err.response.data.error })
				} 
        this.loading = false
      }
		}
	}
}
</script>