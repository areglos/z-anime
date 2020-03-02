<template>
<div>
	<v-row justify="center">
		<v-col sm="8">
			<v-card class="elavation-6 mb-4">
				<v-card-title>Images</v-card-title>
				<v-divider></v-divider>
				<v-card-text class="px-3 py-0">
					<v-row>
						<v-col sm="3">
							<upload-image ref="uploadImage" :selectedImg="setImage" :width="250" :height="324" :img="image"></upload-image>
							<v-img :src="image" height="300px">
								<v-btn small class="mt-2 ml-2" color="primary" @click="$refs.uploadImage.open=true">
	                <v-icon>mdi-upload</v-icon>
	              </v-btn>
							</v-img>
						</v-col>
						<v-col sm="9">
							<upload-image ref="uploadBackground" :selectedImg="setBackground" :width="600" :height="309" :img="background"></upload-image>
							<v-img :src="background" height="300px">
								<v-btn small class="mt-2 ml-2" color="primary" @click="$refs.uploadBackground.open=true">
	                <v-icon>mdi-upload</v-icon>
	              </v-btn>
							</v-img>
						</v-col>
					</v-row>
				</v-card-text>
			</v-card>



			<v-card class="elevation-6">
				<v-card-title>Edit film</v-card-title>
				<v-divider></v-divider>
				<v-card-text>
					<v-text-field label="Film Name" v-model="film.name"></v-text-field>
					<v-text-field label="Other Name" v-model="film.other_name"></v-text-field>
					<v-row>
						<v-col sm="4">
							<v-select :items="types" item-text="name" item-value="id" v-model="film.type_id"></v-select>
						</v-col>
						<v-col sm="4">
							<v-text-field label="All Episode" v-model="film.all_episode"></v-text-field>
						</v-col>
						<v-col sm="4">
							<v-text-field label="Year Release" v-model="film.year_release"></v-text-field>
						</v-col>
					</v-row>

					<v-autocomplete
            v-model="film.categories"
            :items="categories"
            chips
            item-text="name"
            item-value="id"
            label="Categories"
            multiple
          ></v-autocomplete>

					<v-textarea label="Description" v-model="film.description"></v-textarea>
				</v-card-text>

				<v-card-actions>
					<v-btn color="primary" @click="$router.back()">
	        	Back
	        </v-btn>
	        <v-spacer />
	        <v-btn color="primary" @click="editFilm">
	        	Update
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
import UploadImage from '../../components/upload-image'
import FormLoading from '../../components/loading.vue'
export default {
	components: { UploadImage, FormLoading },
	data () {
		return {
			film: {},
			image: '',
			background: '',
			types: [],
			categories: [],
			loading: false
		}
	},
	async created () {
		this.loading = true
		try {
			this.types = (await axios.get('/types')).data
			this.categories = (await axios.get('/categories')).data
			this.film = (await axios.get('/films/' + this.$route.params.id)).data
			this.image = this.$url(this.film.image)
			this.background = this.$url(this.film.background)
		}
		catch (err) {
			this.$bus.$emit('snackbar', { color:'error', text:err.response.data.error })
		}
		this.loading = false
		
	},
	methods: {
		async editFilm () {
			this.loading = true
			try {
				await axios.put('/films/'+ this.$route.params.id, this.film )
				this.$bus.$emit('snackbar', { text: 'Update successful' })
			}
			catch (err) {
				this.$bus.$emit('snackbar', { color:'error', text:err.response.data.error })
			}
			this.loading = false
		},
		setImage(img) {
			this.image = img
			this.film.image = img
		},
		setBackground(img) {
			this.background = img
			this.film.background = img
		}

	}

}

</script>