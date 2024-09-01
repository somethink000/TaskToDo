
<script lang="ts">
	import { defineComponent, ref } from 'vue';
    import draggable from 'vuedraggable';
    import axios from 'axios';


    import BaseLine from './BaseLine.vue';
    import DropDown from './DropDown.vue';
    import ImageButton from './ImageButton.vue';



	export default defineComponent({

        props: {boxid: String, title: String, id: String, setTasks: Array},
		components: {BaseLine, DropDown, ImageButton, draggable},
        data: (instance) => ({
			taskForm: false,
            tasks: instance.setTasks,
            form: {
                text: "",
                done: false,
                sortid: 0,
                taskboxId: instance.id,
                
            },
            drag: false,
		}),

		methods: {
		
            onTaskEnter() {
				console.log(this.form);
				axios.post('/api/tasks', this.form, {
					headers: {
						"Content-type": "application/json"
					}
				})
				.then(res => {
					if (res.data) {
					
                        this.toggleTaskForm();
                        this.tasks.unshift(res.data);
                        this.updateSort();
					} else {
						
					}
				})
			},
            deleteTask(id, idx) {
                axios.delete('/api/tasks/' + id)
                .then(res => {
                    if (res.data) {
                        this.tasks.splice(idx, 1);
                    } else {
                        
                    }
                })
            },
            deleteTaskBox() {
                axios.delete('/api/taskBoxes/' + this.id)
                .then(res => {
                    if (res.data) {
                        this.$emit('on-delete-box', this.boxid)
                    } else {
                        
                    }
                })
            },

            

            updateTask(taskData) {
               
                axios.patch('/api/tasks/' + taskData.id, taskData, {
                    headers: {
                        "Content-type": "application/json"
                    }
                })
                .then(res => {
                    if (res.data) {
                
                    } else {  }
                })

            },

            
            compliteTask(task, index) {
                task.done = !task.done;

                if (index < this.tasks.length){

                    if (task.done) {

                        //Add on the first done row if this done
                        for (var i = index+1; i < this.tasks.length; ++i) {
                            
                            if(this.tasks[i].done == true){
                                var oldPlace = index;
                                var newPlace = i;

                                var t = this.tasks.splice(oldPlace,1);
                                //после того как удалите элемент из массива, у него изменится длина
                                this.tasks.splice(newPlace-1,0,t[0]);

                                return;
                            }
                        }
                    }else{

                        //Add on the first row of task box
                        var t = this.tasks.splice(index,1);
                        this.tasks.unshift(task);
                    }
                }


                this.updateTask(task);
                this.updateSort();
            },


            updateSort(){
                

                for (var i = 0; i < this.tasks.length; ++i) {
                    this.tasks[i].sortid = i;
                }

                axios.post('/api/tasks/update_sort', this.tasks, {
                    headers: {
                        "Content-type": "application/json"
                    }
                })
                .then(res => {
                    if (res.data) {
                        
                    } else {
                       
                    }
                })
            },
            
            orderChanged(item) { 
                this.updateSort(); 

                if (item.added != null ){
                    var task = item.added.element;
                    task.taskboxId = this.id;
                    this.updateTask(task);
                }
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

            <DropDown image="/images/dots.png" size="24">
                <a class="bl-box" @click="toggleTaskForm()">Add Task</a>
                <a class="bl-box" @click="deleteTaskBox()">Delete</a>
            </DropDown>
        </taskBoxHeader>

        <BaseLine />
        
        <!-- <taskBoxList> -->
        <draggable 
        class="taskBoxList"
        ghost-class="ghost"
        v-model="tasks" 
        @change="orderChanged"
        group="people" 
        @start="drag=true" 
        item-key="id">

        <template #item="{element, index}">
            <task class="bl-box main-border" v-bind:class="{ 'complete' : element.done == true}">
                <txt>{{element.text}}</txt>
                <task_acts>
                    <ImageButton @click="deleteTask(element.id, index)" image="/images/cross.png" size="16"/>
                    <ImageButton @click="compliteTask(element, index)" image="/images/check.png" size="16"/>
                </task_acts>
            </task> 
        </template>

        </draggable>
                
            
        <!-- </taskBoxList> -->

    </taskBoxBlock>
</template>


<style>
    

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


        .taskBoxList {
            display: flex;
            width: 100%;
            height: 100%;
            flex-direction: column;
            align-items: center;
            overflow: auto;
            -ms-overflow-style: none;
            scrollbar-width: none;

            task {
                display: flex;
                justify-content: space-between;
                align-items: center;
                border-radius: 10px;
                padding: 2px;
                width: 94%;
                margin-top: 12px;
            
                task_acts {
                    display: flex;
                    border-left: 1px solid rgb(100, 100, 100);
                }
            }


            task.complete {
                background-color: rgb(20, 20, 20);
                color: rgb(100, 100, 100);

                .txt {
                    color: rgb(100, 100, 100);
                }
            }
            task.dragging {
                opacity: 0.1;
            }
        
            taskcomplete {
                display: flex;
                background-color: rgb(20, 20, 20);
                color: rgb(100, 100, 100);

                txt {
                    color: rgb(100, 100, 100);
                }
            }
        }
        
        taskBoxList::-webkit-scrollbar {
            display: none;
        }

    }


    taskBoxBlock.dragging {
        opacity: 0.1;
    }
   
</style>
