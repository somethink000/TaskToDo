
<script>
	import { defineComponent } from 'vue';
	import PrimaryHeader from './components/Header.vue';
	import PrimaryFooter from './components/Footer.vue';

	export default defineComponent({
		components: {
			PrimaryHeader,
			PrimaryFooter,
		},
		setup() {
			return {
			};
		},
	});
</script>


<template>

		<router-view />

</template>


<style>
	

</style>