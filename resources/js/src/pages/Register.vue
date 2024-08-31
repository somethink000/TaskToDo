

<script>
	import { defineComponent } from 'vue';
	import axios from 'axios';

	import BaseLine from '@/components/BaseLine.vue';
	import Header from '@/components/Header.vue';
	import CircleButtonImage from '@/components/CircleButtonImage.vue';

	export default defineComponent({
		components: {
			
			BaseLine,
			Header,
			CircleButtonImage

		},
		data: () => ({
			
		}),
		mounted() {
			
	
		},
		methods: {
			
		
		}
	});
</script>




<template>
	<main>
		<Header> 
			
			<CircleButtonImage @click="this.$router.push('/login')" title="Login" /> 
		</Header> 

		<content>
			register
		</content>
	</main>
</template>

<style>


	main{

		display: flex;
		position: absolute;
		margin: auto;
		height: 98%;
		width: 98%;
		flex-direction: column;

		content {
			display: flex;
			height: 100%;
			flex-direction: row;
		
	
		}
	}
</style>