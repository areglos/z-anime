<template>
<div>
<h1>Bớt cục súc lại</h1>
</div>
</template>

<script>
import axios from 'axios'
export default {
	created () {
		axios.post('/test')
			.then(res => console.log(res.data))
	},
	methods: {
		test () {
			this.$bus.$emit('snackbar', { text:'Call snackbar'})
		}
	}
}

</script>