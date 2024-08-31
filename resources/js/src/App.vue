
<script>
	import { defineComponent } from 'vue';
	import { mapGetters, mapActions } from "vuex";

	export default defineComponent({
		components: {},
		computed: {
			...mapGetters("auth", ["user"])
		},
		data: () => ({

		}),
		mounted() {
			this.getUserData();
		},
		methods: {
			...mapActions("auth", ["getUserData"]),
		}
	});
</script>


<template>

		
		<router-view />

</template>


<style>
	

</style>