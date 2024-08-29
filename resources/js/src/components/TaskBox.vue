
<script lang="ts">
	import { defineComponent, ref } from 'vue';
    import draggable from 'vuedraggable';
    import axios from 'axios';


    import BaseLine from './BaseLine.vue';
    import TaskComponent from './TaskComponent.vue';
    import DropDown from './DropDown.vue';
    import ImageButton from './ImageButton.vue';



	export default defineComponent({

        props: {title: String, id: String},
		components: {BaseLine, TaskComponent, DropDown, ImageButton, draggable},
        data: (instance) => ({
			tasks: [],
			taskForm: false,
            form: {
                text: "",
                done: false,
                sortid: 0,
                taskboxId: instance.id,
                
            },
            enabled: true,
            list: [
                { name: "John", id: 0 },
                { name: "Joao", id: 1 },
                { name: "Jean", id: 2 }
            ],
            dragging: false
		}),
		mounted() {
			this.loadTasks();
	
		},
		methods: {
			loadTasks() {
				axios.get('/api/tasks')
					.then(res => {
						console.log(res.data);
						this.tasks = res.data;
	
					})
			},
            onTaskEnter() {
				console.log(this.form);
				axios.post('/api/tasks', this.form, {
					headers: {
						"Content-type": "application/json"
					}
				})
				.then(res => {
					if (res.data) {
						console.log(res.data);
					} else {
						console.log(res.data);
					}
				})
			},
            checkMove: function(e) {
                window.console.log("Future index: " + e.draggedContext.futureIndex);
            },
            toggleTaskForm() { this.taskForm = !this.taskForm; },
            
		}
	});
</script>


<template>
    <taskBoxBlock>

        <taskBoxHeader>
           
            <input v-if="taskForm == true" v-on:keyup.enter="onTaskEnter()" v-model="this.form.text"  type="text" placeholder="New task" >
            <ttl v-else >{{ title }}</ttl> 
            
            <ImageButton @click="toggleTaskForm()" image="/images/plus.png" size="20"/>
           
        </taskBoxHeader>

        <BaseLine />
        
        <taskBoxList>
            <draggable 
            v-model="list" 
            group="people" 
            @start="drag=true" 
            @end="drag=false" 
            item-key="id">
            <template #item="{element}">
                <div>{{element.name}}</div>
            </template>
            </draggable>
                 
            <!-- <TaskComponent v-for="task in tasks" :text="task.text" /> -->
        </taskBoxList>

    </taskBoxBlock>
</template>


<style lang="scss">
    

    .ghost {
        opacity: 0.5;
        background: #c8ebfb;
    }


   taskBoxBlock {
    background-color: rgb(50, 50, 50);
    display: flex;
    flex-direction: column;
    border-radius: 10px;
    width: 300px;
    margin: 10px;
    max-height: 45vh;


        taskBoxHeader {
            display: flex;
            padding: 8px;
            justify-content: row;
            justify-content: space-between;
            align-items: center;
        }


        taskBoxList {
            display: flex;
            width: 100%;
            height: 100%;
            flex-direction: column;
            align-items: center;
            overflow: auto;
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        taskBoxList::-webkit-scrollbar {
            display: none;
        }

    }


    taskBoxBlock.dragging {
        opacity: 0.1;
    }
   
</style>
