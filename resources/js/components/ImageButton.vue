<script>
	import { defineComponent } from 'vue';

	export default defineComponent({

        
        props: ['image', 'size'],
		components: {},
		setup() {
            
			return {};
		},
	});
</script>


<template>

	<button>
        <img :src="image" :width="size" />
    </button>
   
</template>

<style>
   button{
	display: flex;
	padding: 6px;
    background-color: transparent;
   }
  

</style>