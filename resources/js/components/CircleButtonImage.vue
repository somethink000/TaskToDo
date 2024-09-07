
<script>
	import { defineComponent } from 'vue';

	export default defineComponent({

        
        props: ['title', 'image'],
		components: {},
		setup() {
            
			return {};
		},
	});
</script>


<template>

	<button class="bl-box main-border">
        <img v-if="image != null" :src="image" width="32" />
        <txt class="txt">{{title}}</txt>
    </button>
   
</template>

<style>
   
  

</style>
