
<script>
	import { defineComponent } from 'vue';
	import { AuthStore } from '@/store/AuthStore.js';
	import { mapStores } from 'pinia';

	const pep = "dwd";
	//const {CheckAuth}=AuthStore()
	// const { if_authenticated } = storeToRefs(AuthStore()) 

	export default defineComponent({
		components: {},
		computed: {
			...mapStores(AuthStore),
		},
		data: () => ({
			
		}),
		mounted() {

			
			
			// const {ok} =  await CheckAuth()

			// 	console.log(ok)
			// if(!ok)
			// {
			
			// 	console.log("entra")
			// 	// router.push({ name:'login'})
			// }  
			this.Verify();
		},
		methods: {

			Verify() {
				// await this.authStore.testpopo();
				this.authStore.CheckAuth();
				//console.log(import.meta.env.VITE_API_URL);
			},
			
		}
	});
</script>


<template>

		
		<router-view />

</template>


<style>
	

</style>