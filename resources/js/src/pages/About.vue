

<script>
	import { defineComponent } from 'vue';
	import axios from 'axios';

	
	import PlanedTasksBox from '@/components/PlanedTasksBox.vue';
	import TasksBox from '@/components/TaskBox.vue';
	import TaskBoxForm from '@/components/TaskBoxForm.vue';
	import BaseLine from '@/components/BaseLine.vue';
	import Header from '@/components/Header.vue';
	import CircleButtonImage from '@/components/CircleButtonImage.vue';

	export default defineComponent({
		components: {
			
			PlanedTasksBox,
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
					
					console.log(this.boxes);
					for (var i = 0; i < this.boxes.length; ++i) {
						
						this.boxes[i].tasks.sort(function (a, b) {
							return a.sortid - b.sortid;
						});
					}
				})

				
				
			},
			closeBoxForm() {this.boxForm = false;},
			openBoxForm() {this.boxForm = true;},

			onDeleteBox(id){
				this.boxes.splice(id, 1);
			},
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
				<PlanedTasksBox />
			</planPanel>

			<boxesplace>
				<TasksBox @on-delete-box="onDeleteBox" v-for="(box, index) in boxes" :boxid="index" :title="box.title" :id="box.id" :setTasks="box.tasks"/>
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
				/* justify-content: center; */
				flex-wrap: wrap;
			}
		}
	}
</style>