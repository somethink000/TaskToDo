



<script>
	import { defineComponent } from 'vue';
	
	import BaseLine from '@/components/BaseLine.vue';

	export default defineComponent({
		components: {BaseLine},
		setup() {
			return {};
		},
	});
</script>


<template>
	<header>
		<ttl>TaskToDo</ttl>
		<controls>
			<slot />
		</controls>
		
	</header>
	<BaseLine/>
</template>

<style>

	header{
		display: flex;
		width: 100%;
		max-width: 100%;
		flex-direction: center;
		align-items: center;
		justify-content: space-between;
		flex-direction: row;

		
		controls{
			display: flex;
			margin-right: 5px;
			align-items: center;
		}
	
	}
	
</style>