<template>
	
	
	<div class="container vh-100 flex-column justify-content-center align-items-center">

			<PrimaryHeader />

			<main class="main">
				<router-view />
			</main>

			<PrimaryFooter />

	</div>
</template>

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
