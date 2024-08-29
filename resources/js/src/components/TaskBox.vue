
<script lang="ts">
	import { defineComponent } from 'vue';
    import axios from 'axios';


    import BaseLine from './BaseLine.vue';
    import TaskComponent from './TaskComponent.vue';
    import DropDown from './DropDown.vue';
    import ImageButton from './ImageButton.vue';



	export default defineComponent({

        props: {title: String, id: String},
		components: {BaseLine, TaskComponent, DropDown, ImageButton},
        data: (instance) => ({
			tasks: [],
			taskForm: false,
            form: {
                text: "",
                done: false,
                sortid: 0,
                taskboxId: instance.id,
                
            },
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
            <!-- <DropDown>
                <a href="#">Delete</a>
            </DropDown> -->
            
        </taskBoxHeader>

        <BaseLine />

        <taskBoxList>
            <TaskComponent v-for="task in tasks" :text="task.text" />
        </taskBoxList>

    </taskBoxBlock>
</template>


<style lang="scss">
   
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
