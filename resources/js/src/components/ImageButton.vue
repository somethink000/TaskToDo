
<script lang="ts">
	import { defineComponent } from 'vue';

	export default defineComponent({

        
        props: ['image'],
		components: {},
		setup() {
            
			return {};
		},
	});
</script>


<template>

	<button>
        <img :src="image" width="32" />
    </button>
   
</template>

<style>
   button{
    background-color: transparent;
   }
  

</style>
