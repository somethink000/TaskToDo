

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
			dates: [],
			boxForm: false,
		}),
		mounted() {
			this.loadBoxes();
			this.setupDates();
		},
		methods: {
			setupDates() {
				
				for (var i = 0; i < 7; ++i) {
					
					var date = new Date();
					date.setDate(date.getDate() + i);

					this.dates[i] = date;
					
				}

				
			},

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
				<PlanedTasksBox>
					
					<dateBox class="main-border bl-box" v-for="(date, index) in dates">

						<txt>{{ date.toLocaleDateString() }} {{ date.getDay() }}</txt>

						<BaseLine />

						<draggable 
						class="dateTasksList"
						ghost-class="ghost"
						v-model="date.tasks" 				
						group="people" 
						item-key="id">

						<template #item="{element, index}">
							<!-- <task class="bl-box main-border" v-bind:class="{ 'complete' : element.done == true}">
								<txt>{{element.text}}</txt>
								<task_acts>
									<ImageButton @click="deleteTask(element.id, index)" image="/images/cross.png" size="16"/>
									<ImageButton @click="compliteTask(element, index)" image="/images/check.png" size="16"/>
								</task_acts>
							</task>  -->
						</template>

						</draggable>
					</dateBox>
				</PlanedTasksBox>
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