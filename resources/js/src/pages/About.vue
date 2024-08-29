

<script>
	import { defineComponent } from 'vue';
	import axios from 'axios';

	import CircleButtonImage from '@/components/CircleButtonImage.vue';
	import TodayTasksBox from '@/components/TodayTasksBox.vue';
	import TasksBox from '@/components/TaskBox.vue';
	import TaskBoxForm from '@/components/TaskBoxForm.vue';
	import BaseLine from '@/components/BaseLine.vue';

	
	export default defineComponent({
		components: {
			CircleButtonImage,
			TodayTasksBox,
			TasksBox,
			TaskBoxForm,
			BaseLine

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

	
		<controls>
			<CircleButtonImage @click="openBoxForm()" title="New Task Box" image="/images/plus.png"/>
		</controls>
		<BaseLine/>
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
		flex-direction: column;

		
		controls{
			display: flex;
			width: 100%;
			height: 5%;
			margin: 5px;
			align-items: center;
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