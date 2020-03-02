<template>
<div>
	<v-row justify="center">
		<v-col sm="9">
			<v-toolbar dark color="elavation-2" dense class="mb-2">
			  <v-btn color="primary" class="mr-3" @click="dialog=true">Add new</v-btn>
			  <v-text-field
			    class="mr-3"
			    hide-details
			    placeholder="Search"
			    width="100"
			    append-icon="mdi-magnify"
			    single-line
			    v-model="query.keyword"
			    style="max-width:300px"
			  ></v-text-field>
			  <v-select
			    class="mr-3"
			    hide-details
			    :items="shows"
			    v-model="query.show"
			    placeholder="Show"
			    single-line
			    style="max-width:100px"
			  ></v-select>
			</v-toolbar>

			<v-data-table
	      :headers="headers"
	      :items="categories"
	      :items-per-page="query.show"
	      hide-default-footer
    	>
	    	<template v-slot:item.name="props">
	        <v-edit-dialog
	          :return-value.sync="props.item.name"
	          @save="updateCat(props.item)"
	        > {{ props.item.name }}
	          <template v-slot:input>
	            <v-text-field
	              v-model="props.item.name"
	              label="Edit"
	              single-line
	              counter
	            ></v-text-field>
	          </template>
	        </v-edit-dialog>
	      </template>
	      <template v-slot:item.action="props">
	        <v-btn icon @click="deleteCat(props.item)"><v-icon>mdi-delete</v-icon></v-btn>
	      </template>


    	</v-data-table>
		</v-col>
	</v-row>
	<form-loading :loading="loading"></form-loading>
	<!-- New Cat -->
	<v-dialog v-model="dialog" max-width="500">
	  <v-card>
	    <v-card-title>Add new film</v-card-title>
	    <v-divider></v-divider>
	    <v-card-text>
	      <v-text-field label="Film Name" v-model="newCatName" />
	    </v-card-text>
	    <v-divider></v-divider>
	    <v-card-actions>
	      <v-spacer></v-spacer>
	      <v-btn color="primary" @click="createCat">Add</v-btn>
	    </v-card-actions >
	  </v-card>
	</v-dialog>
</div>
</template>

<script>
import axios from 'axios'
import FormLoading from '../components/loading.vue'
export default {
	components: { FormLoading },
	data () {
		return {
			dialog: false,
			headers: [
        { text: 'Name', value: 'name', sortable: false },
        { text: 'Films', value: 'films_count' },
        { text: 'Action', value: 'action', align:'right'}
      ],
			categories: [],
			shows: [20,40,60],
			query: {
				keyword: null,
				show: 20
			},
			loading: false,
			newCatName: ''
		}
	},
	created () {
		this.getCategories()
	},
	methods: {
		getCategories () {
			this.loading = true
      setTimeout(() => {
        axios.get('/categories', { params: this.query })
          .then(res => {
            this.categories = res.data
            this.loading = false
          })
      },300)
		},
		async createCat () {
			this.loading = true
			try {
				let cat = (await axios.post('/categories', {name: this.newCatName} )).data
				this.categories.push({ ...cat, films_count: 0})
				this.$bus.$emit('snackbar', { text: 'Completed' })
				this.dialog = false
			}
			catch (err) {
				this.$bus.$emit('snackbar', { color:'error', text:err.response.data.error })
			}
			this.loading = false
		},
		async updateCat (cat) {
			this.loading = true
			try {
				await axios.put('/categories/'+cat.id, cat)
				this.$bus.$emit('snackbar', { text: 'Category has been edited' })
			}
			catch (err) {
				this.$bus.$emit('snackbar', { color:'error', text:err.response.data.error })
			}
			this.loading = false
		},
		async deleteCat(cat) {
			if (confirm('Confirm delete this cat')) {
				this.loading = true
				await axios.delete('/categories/'+cat.id)
				const index = this.categories.indexOf(cat)
				this.categories.splice(index,1)
				this.loading = false
			}
			
		}
	}
}

</script>