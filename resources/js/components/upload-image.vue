<template>
<div>
<v-dialog v-model="open" width="500">
  <v-card>
    <v-card-title class="headline">Upload Image</v-card-title>
    <v-divider></v-divider>
    <v-card-text>
    	<input ref="input" type="file" name="image" accept="image/*" @change="setImage" style="display:none"/>
    	<vue-cropper
			  ref="cropper"
			  :src="imgSrc"
			  :cropBoxResizable="false"
			  :aspect-ratio="width/height"
			  alt="Source Image"
			>
			</vue-cropper>

    </v-card-text>

    <v-divider></v-divider>
    <v-card-actions>
    	<v-btn color="success" @click="$refs.input.click()"><v-icon>mdi-upload</v-icon></v-btn>
      <v-spacer></v-spacer>
      <v-btn color="primary" text @click="uploadImage" > I accept </v-btn>
    </v-card-actions>
  </v-card>
</v-dialog>

</div>
</template>

<script>
import VueCropper from 'vue-cropperjs'
import 'cropperjs/dist/cropper.css'
export default {
	props: ['img','width', 'height', 'selectedImg'],
	components: { VueCropper },
	data () {
		return {
			open:false,
			imgSrc: null,
			inputname: 'abcd',
			test:'asd'
		}
	},
	watch: {
		open (val) {
			if (!val) this.imgSrc = null
			else this.imgSrc = this.img
		}
	},
	methods: {
		setImage(e) {
      const file = e.target.files[0];
      if (file.type.indexOf('image/') === -1) {
        alert('Please select an image file');
        return;
      }
      if (typeof FileReader === 'function') {
        const reader = new FileReader();
        reader.onload = (event) => {
          this.imgSrc = event.target.result;
          // rebuild cropperjs with the updated source
          this.$refs.cropper.replace(event.target.result);
        };
        reader.readAsDataURL(file);
      } else {
        alert('Sorry, FileReader API not supported');
      }
    },
		uploadImage () {
			let img = this.$refs.cropper.getCroppedCanvas({
        width: this.width,
        height: this.height,
        fillColor: '#fff'
      }).toDataURL('image/jpeg', 0.8);
			this.selectedImg(img)
			this.open= false
		},
	}
}

</script>

<style>
.cropped-image img {
  max-width: 100%;
}
</style>