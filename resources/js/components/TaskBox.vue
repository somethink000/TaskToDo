
<script lang="ts">
	import { defineComponent, ref } from 'vue';
    import draggable from 'vuedraggable';
    import axios from 'axios';


    import BaseLine from './BaseLine.vue';
    import DropDown from './DropDown.vue';
    import ImageButton from './ImageButton.vue';

	export default defineComponent({

        props: {title: String, id: String, setTasks: Array},
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
        computed: {
           
        },
        mounted() {
            
            this.initTasks();
		},
		methods: {
            
            initTasks() {
                for (var i = 0; i < this.tasks.length; ++i) {

                    var task = this.tasks[i];

                    //check all complited planed tasks
                    if(task.done == true && task.planed_at != null){
                        task.planed_at = null;
                        task.done = false;
                        this.compliteTask(task, i);
                    }

                }
            },

            onTaskEnter() {
                
               

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

                this.form.text = "";
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

                        
                        for (var i = index+1; i < this.tasks.length; ++i) {
                            
                            //Add on the first done row if this done
                            if(this.tasks[i].done == true){
                                var oldPlace = index;
                                var newPlace = i;

                                var t = this.tasks.splice(oldPlace,1);
                                //после того как удалите элемент из массива, у него изменится длина
                                this.tasks.splice(newPlace-1,0,t[0]);
                                
                                break;
                            }
                            //no doned tasks fix
                            else if ( i == this.tasks.length-1) {
                                var oldPlace = index;
                                var newPlace = i;

                                var t = this.tasks.splice(oldPlace,1);
                                this.tasks.push(t[0]);
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
                    task.planed_at = null;
                    this.updateTask(task);
                }
            },
            
            toggleTaskForm() { this.taskForm = !this.taskForm; },
            
		}
	});
</script>


<template>
    <taskBoxBlock class="bl-box">

        <taskBoxHeader>
           
        
            <input v-if="taskForm == true" v-on:keyup.enter="onTaskEnter" ref="inp" v-model="this.form.text"  type="text" placeholder="New task" >
           
            <ttl v-else >{{ title }}</ttl> 

            <DropDown image="/images/dots.png" size="24">
                <a class="wh-box" @click="toggleTaskForm()">Add Task</a>
                <a class="wh-box" @click="deleteTaskBox()">Remove</a>
            </DropDown>
        </taskBoxHeader>

        <BaseLine />
        
        <!-- <taskBoxList> -->
        <draggable 
        class="taskBoxList"
        ghost-class="ghost"
        v-model="tasks" 
        @change="orderChanged"
        :group="{ name: 'tasks', pull: true, put: true }"
        :animation="200"
        >

        <template #item="{element, index} ">
            <task class="bl-box main-border" v-bind:class="{ 'complete' : element.done == true, 'planed' : element.planed_at != null && element.done != true }" >
                <txt>{{element.text}}</txt>
                <task_acts>
                    <ImageButton @click="deleteTask(element.id, index)" image="/images/cross.png" size="18"/>
                    <ImageButton @click="compliteTask(element, index)" image="/images/check.png" size="18"/>
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
    box-shadow: 0px 8px 16px 0px rgba(95, 95, 95, 0.5);
    /* background-color: rgb(50, 50, 50); */
    display: flex;
    flex-direction: column;
    border-radius: 10px;
    width: 300px;
    margin: 10px;
    max-height: 45vh;
    padding-bottom: 10px;

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
            min-height: 50px;
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
                
                txt{
                    width:80%; word-wrap:break-word; display:inline-block;
                }

                task_acts {
                    display: flex;
                    align-items: center;
                    border-left: 1px solid rgb(100, 100, 100);

                    ImageButton{
                        margin-right: 6px;
                    }
                }
            }

            
            task.complete {
                background-color: rgb(20, 20, 20);
                color: rgb(100, 100, 100);

                .txt {
                    color: rgb(100, 100, 100);
                }
            }

            task.planed {
                background-color: rgb(83, 83, 83);
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
