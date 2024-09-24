

<script>
	import { defineComponent } from 'vue';
	import axios from 'axios';
	import draggable from 'vuedraggable';
	import moment from "moment";
	import { useTodoStore } from '@/stores/todo.js'
	import { mapActions, mapStores } from 'pinia'

	
	import TasksBox from '@/components/TaskBox.vue';
	import DateTaskBox from '@/components/TaskBoxPlaned.vue';
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
			boxForm: false,
			
		}),
		computed: {
			...mapStores(useTodoStore),

			boxes() {return this.todoStore?.currentBoxes},
			dates() {return this.todoStore?.currentDates},
			
		},
		mounted() {
			this.loadTodo();
		},
		methods: {
			
			...mapActions(useTodoStore, ['load_data']),
			
			loadTodo() {
				this.load_data().then(() => {})
			},
			
			
			closeBoxForm() {this.boxForm = false;},
			openBoxForm() {this.boxForm = true;},

			
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
					
					<DateTaskBox v-for="(date) in dates.keys()" :date="date"/>
					
				</planPanelContent>
			</planPanel>

			<boxesplace>
				<TasksBox v-for="(box) in boxes.keys()" :id="box"/>
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
			height: 92%;
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
				padding: 10px;
				max-height: 100%;
				-ms-overflow-style: none;
				scrollbar-width: none;
			}
		}

		@media screen and (max-width: 600px) {
			content {
				flex-direction: column;
				height: auto;
				align-items: center;
				planPanel{
					width: 100%;
					height: 430px; 
					planPanelContent{
						
						overflow: hidden;
					}
				}

				boxesplace{
					margin-top: 30px;
					flex-direction: column;
					flex-wrap: none;
					width: 98%;
					height: 100%;
					padding: 0px;
					overflow: none;
					


					taskBoxBlock {
						width: 100%;
						margin-right: none;
						
					}
				}
			}
		}
	}
</style>