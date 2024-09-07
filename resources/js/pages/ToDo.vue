

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
			boxes: new Map([]),
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

			},

			loadBoxes() {
				axios.get('/api/taskBoxes')
				.then(res => {
					
					var boxesData = res.data
					
					for (var i = 0; i < boxesData.length; ++i) {
						
						this.boxes.set( boxesData[i].id, boxesData[i]);
					
						var box = this.boxes.get(boxesData[i].id);
						var today = new Date();

						
						for (var v = box.tasks.length-1; v >= 0; --v) {
							var task = box.tasks[v];
						
							if (task.planed_at != null) {

								var lesToday = new Date(task.planed_at).getDay() < today.getDay();
								
								if (lesToday) {
									if(task.done){
										continue;
									}
									task.dedline = true;
									this.dates.get(today.toLocaleDateString()).tasks.push(task);
									box.tasks.splice(v, 1);
								}else{
									this.dates.get(task.planed_at).tasks.push(task);
									box.tasks.splice(v, 1);
								}
							
							}
						}

						box.tasks.sort(function (a, b) {
							return a.sort_id - b.sort_id;
						});
					}

				})
			},
			
			closeBoxForm() {this.boxForm = false;},
			openBoxForm() {this.boxForm = true;},

			onDeleteBox(id){
				this.boxes.delete(id);
			},
			onCreatedBox(e) {
				e.tasks = [];
				this.boxes.set( e.id, e);
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
					
					<DateTaskBox v-for="(date) in dates.keys()" :date="date" :boxes="boxes" :setTasks="dates.get(date).tasks" />
					
				</planPanelContent>
			</planPanel>

			<boxesplace>
				<TasksBox @on-delete-box="onDeleteBox(box)" v-for="(box) in boxes.keys()" :title="boxes.get(box).title" :id="boxes.get(box).id" :setTasks="boxes.get(box).tasks"/>
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
			height: 95%;
			flex-direction: row;
		
		
			planPanel {
				display: flex;
				width: 420px;
				height: 100%; 
				max-height: 100%;

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
				flex-direction: row;
				flex-wrap: wrap;
				align-items: flex-start;
				/* justify-content: center; */
				width: 80%;
				overflow: auto;
				max-height: 100%;
				-ms-overflow-style: none;
				scrollbar-width: none;
			}
		}
	}
</style>