

<script>
	import { defineComponent } from 'vue';
	import CircleButtonImage from '@/components/CircleButtonImage.vue';

	export default defineComponent({
		components: {
			CircleButtonImage,
		},
		setup() {
			return {};
		},
	});
</script>




<template>
	<main>
		<today>
			<controls>
				<CircleButtonImage title="New TaskBox" image="/images/plus.png"/>
			</controls>
		</today>
		<boxesplace>

		</boxesplace>
	</main>
</template>

<style>


	main{

		display: flex;
		position: absolute;
		margin: auto;
		height: 98%;
		width: 98%;
		flex-direction: row;

		today{
			display: flex;
			flex-direction: column;
			border-radius: 10px;
			padding: 12px;
			width: 360px;
			height: 100%;
			max-height: 100%;

			controls{
				display: flex;
				width: 100%;
				padding: 10px;
				align-items: center;
			}
		}
		boxesplace{
			display: flex;
			padding: 6px;
			width: 100%;
			height: 100%;
			max-height: 100%;
			flex-direction: row;
		}
	}
</style>