<template>
	
	<div class="py-4 flex-column justify-content-center">

		<div class="p-5 mb-4 bg-body-tertiary rounded-3">
			<div class="container-fluid py-5 flex-column">

				<h1 class="display-5 fw-bold">Your Auth</h1>
				<p class="col-md-8 fs-4">Simple authorization tool for you and for your projects</p>
		
			</div>
		</div>
		<div class="row align-items-md-stretch">
			<div class="col-md-6">
				<div class="h-100 p-5 text-bg-dark rounded-3 flex-column">
					<h2>How to use</h2>
					<p>Register your new profile and then you can autorize your data in anouther services by two clicks.</p>
					<!-- <button class="btn btn-outline-light" type="button">Example button</button> -->
				</div>
			</div>
			<div class="col-md-6">
				<div class="h-100 p-5 bg-body-tertiary border rounded-3 flex-column">
					<h2>How to use in projects</h2>
					<p>You need to verify API key for your project and use incoming information for autorize and register client data. More details in link below</p>
					<button class="btn btn-outline-secondary" type="button">Documentation</button>
				</div>
			</div>
		</div>	
  </div>
</template>

<script>
	import { defineComponent } from 'vue';

	export default defineComponent({
		components: {},
		setup() {
			return {};
		},
	});
</script>
