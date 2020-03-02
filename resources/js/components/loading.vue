<template>
<v-overlay
  :absolute="true"
  :opacity="0.3"
  :value="loading"
>
  <v-card
    color="primary"
    dark
    style="width:300px"
  >
    <v-card-text>
      Loading...
      <v-progress-linear
        indeterminate
        color="white"
        class="mb-0"
      ></v-progress-linear>
    </v-card-text>
  </v-card>
</v-overlay>
</template>

<script>
export default {
	props: ['loading'],
}
</script>