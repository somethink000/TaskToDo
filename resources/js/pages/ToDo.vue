

<script>
	import { defineComponent } from 'vue';
	import axios from 'axios';
	import draggable from 'vuedraggable';


	
	import TasksBox from '@/components/TaskBox.vue';
	import DateTaskBox from '@/components/DateTaskBox.vue';
	import TaskBoxForm from '@/components/TaskBoxForm.vue';
	import BaseLine from '@/components/BaseLine.vue';
	import Header from '@/components/Header.vue';
	import CircleButtonImage from '@/components/CircleButtonImage.vue';
	


	export default defineComponent({
		components: {
			
			DateTaskBox,
			TasksBox,
			TaskBoxForm,
			BaseLine,
			Header,
			CircleButtonImage,
			draggable

		},
		data: () => ({
			boxes: {},
			dates: new Map([]),
			boxForm: false,
			
		}),
		mounted() {
			this.setupDates();
			this.loadBoxes();
		},
		methods: {
			setupDates() {
				
				for (var i = 0; i < 7; ++i) {
					
					var date = new Date();
					date.setDate(date.getDate() + i);
					date = date.toLocaleDateString();
					
					this.dates.set( date, {tasks: []});
					
				}


				// console.log(this.dates);
				
			},

			loadBoxes() {
				axios.get('/api/taskBoxes')
				.then(res => {
					this.boxes = res.data;
					
					console.log(this.boxes);
					for (var i = 0; i < this.boxes.length; ++i) {
						
						var box = this.boxes[i];
						var today = new Date();

						for (var i = 0; i < box.tasks.length; ++i) {
							var task = box.tasks[i];

							if (task.planed_at != null) {
								
								if (new Date(task.planed_at) < today && task.done != true) {
									task.dedline = true;
									this.dates.get(today.toLocaleDateString()).tasks.push(task);
								}else{
									this.dates.get(task.planed_at).tasks.push(task);
								}
							
							}
						}

						box.tasks.sort(function (a, b) {
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
				<planPanelContent>
					
					<DateTaskBox v-for="(date, index) in dates.keys()" :date="date" :setTasks="dates.get(date).tasks" />
					
				</planPanelContent>
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
				width: 420px;
				height: 100%;
				max-height: 100%;
				padding: 16px;

				planPanelContent {
					display: flex;
					flex-direction: column;
					border-radius: 10px;
					padding: 10px;
					width: 100%;
					height: 100%;
					overflow: auto;
					-ms-overflow-style: none;
					scrollbar-width: none;
				}	

				planPanelContent::-webkit-scrollbar {
					display: none;
				}

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