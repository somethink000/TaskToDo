

<script>
	import { defineComponent } from 'vue';
	import CircleButtonImage from '@/components/CircleButtonImage.vue';
	import TodayTasksBox from '@/components/TodayTasksBox.vue';
	import TasksBox from '@/components/TaskBox.vue';


	export default defineComponent({
		components: {
			CircleButtonImage,
			TodayTasksBox,
			TasksBox
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

			<boxTodayPlace>
				<TodayTasksBox />
			</boxTodayPlace>
			

		</today>
		<boxesplace>
			<TasksBox title="larace"/>
			<TasksBox title="larace"/>
			<TasksBox title="larace"/>
			<TasksBox title="larace"/>
			<TasksBox title="larace"/>
			<TasksBox title="larace"/>
			<TasksBox title="larace"/>
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
			width: 400px;
			height: 100%;
			max-height: 100%;

			controls{
				display: flex;
				width: 100%;
				padding: 10px;
				height: 5%;
				align-items: center;
			}

			boxTodayPlace{
				height: 85%;
			}
		}
		boxesplace{
			display: flex;
			width: 100%;
			height: 100%;
			max-height: 100%;
			flex-direction: row;
			justify-content: center;
			flex-wrap: wrap;
		}
	}
</style>