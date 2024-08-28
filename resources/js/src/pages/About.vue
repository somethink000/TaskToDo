

<script>
	import { defineComponent } from 'vue';
	import axios from 'axios';

	import CircleButtonImage from '@/components/CircleButtonImage.vue';
	import TodayTasksBox from '@/components/TodayTasksBox.vue';
	import TasksBox from '@/components/TaskBox.vue';
	import TaskBoxForm from '@/components/TaskBoxForm.vue';

	
	export default defineComponent({
		components: {
			CircleButtonImage,
			TodayTasksBox,
			TasksBox,
			TaskBoxForm
		},
		data: () => ({
			boxes: [],
			boxForm: false,
		}),
		mounted() {
			this.loadBoxes();
	
		},
		methods: {
			loadBoxes() {
				axios.get('/api/taskBoxes')
					.then(res => {
						console.log(res.data);
						this.boxes = res.data;
	
					})
				
			},
			closeBoxForm() {
				this.boxForm = false;
			},
			openBoxForm() {
				this.boxForm = true;
			}
		
		}
	});
</script>




<template>
	<main>

		<TaskBoxForm v-if="this.boxForm == true" @someEvent="closeBoxForm()"/>

		<today>

			<controls>
				<CircleButtonImage @click="openBoxForm()" title="New TaskBox" image="/images/plus.png"/>
			</controls>

			<boxTodayPlace>
				<TodayTasksBox />
			</boxTodayPlace>
			

		</today>
		<boxesplace>
			<TasksBox v-for="box in boxes" :title="box.title" />
			
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