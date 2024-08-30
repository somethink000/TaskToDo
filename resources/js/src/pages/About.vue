

<script>
	import { defineComponent } from 'vue';
	import axios from 'axios';

	
	import TodayTasksBox from '@/components/TodayTasksBox.vue';
	import TasksBox from '@/components/TaskBox.vue';
	import TaskBoxForm from '@/components/TaskBoxForm.vue';
	import BaseLine from '@/components/BaseLine.vue';
	import Header from '@/components/Header.vue';
	import CircleButtonImage from '@/components/CircleButtonImage.vue';

	export default defineComponent({
		components: {
			
			TodayTasksBox,
			TasksBox,
			TaskBoxForm,
			BaseLine,
			Header,
			CircleButtonImage

		},
		data: () => ({
			boxes: {},
			boxForm: false,
		}),
		mounted() {
			this.loadBoxes();
	
		},
		methods: {
			loadBoxes() {
				axios.get('/api/taskBoxes')
					.then(res => {
						this.boxes = res.data;
						
					})
				
			},
			closeBoxForm() {this.boxForm = false;},
			openBoxForm() {this.boxForm = true;},

			onCreatedBox(e) {
				this.boxes.unshift(e);
				this.closeBoxForm();
			},
			
		
		}
	});
</script>




<template>
	<main>
		<Header> 
			<CircleButtonImage @click="openBoxForm()" title="New Task Box" image="/images/plus.png"/> 
		</Header> 

		<TaskBoxForm v-if="this.boxForm == true" @on-created-box="onCreatedBox" @close-boxform="closeBoxForm()"/>
		<content>
			

			<planPanel>
				<TodayTasksBox />
			</planPanel>

			<boxesplace>
				<TasksBox v-for="box in boxes" :title="box.title" :id="box.id" :setTasks="box.tasks"/>
			</boxesplace>
		</content>
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

		content {
			display: flex;
			height: 100%;
			flex-direction: row;
		
		
			planPanel {
				display: flex;
				width: 18%;
				height: 100%;
				max-height: 100%;
			}

			boxesplace{
				display: flex;
				width: 80%;
				height: 100%;
				max-height: 100%;
				flex-direction: row;
				justify-content: center;
				flex-wrap: wrap;
			}
		}
	}
</style>