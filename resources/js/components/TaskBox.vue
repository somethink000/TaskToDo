
<script>
	import { defineComponent, ref } from 'vue';
    import draggable from 'vuedraggable';
    import axios from 'axios';
    import { useTodoStore } from '@/stores/todo.js'
	import { mapActions, mapStores } from 'pinia'


    import BaseLine from './BaseLine.vue';
    import DropDown from './DropDown.vue';
    import ImageButton from './ImageButton.vue';

	export default defineComponent({

        props: {id: String},
		components: {BaseLine, DropDown, ImageButton, draggable},
        data: (instance) => ({
			taskForm: false,
            form: {
                text: "",
                done: false,
                sort_id: 0,
                taskbox_id: instance.id,
                
            },
           
            drag: false,
		}),
        computed: {
            ...mapStores(useTodoStore),

            box() {return this.todoStore?.getBox(this.id)},
        },
        mounted() {
            this.fetchNewComplited();
		},
		methods: {
        
            ...mapActions(useTodoStore, [
                'update_tasks_sort',
                'create_task', 
                'complite_task', 
                'delete_task',
                'update_task',
                'delete_taskbox'
            ]),
            
            fetchNewComplited() {
                for (var v = 0; v < this.box.tasks.length; v++) {
                    var task = this.box.tasks[v];

                    
                    if ( task.planed_at != null && task.done == true ) {
                        task.planed_at = null;
                        task.done = false;
                        this.complite_task(task, v);
                    }   
                }
            },

            onTaskEnter() {
                
				this.create_task(this.form).then((res) => {
                    
                    this.toggleTaskForm();
                    this.form.text = "";
                })
            },
            

            orderChanged(item) { 

                this.update_tasks_sort(this.id).then((res) => {
    
                    if (item.added != null ){
                        var task = item.added.element;
                        task.taskbox_id = this.id;
                        task.planed_at = null;
                        this.update_task(task).then((res) => {});
                    }
                });
            },


            toggleTaskForm() { this.taskForm = !this.taskForm; },
            
		}
	});
</script>


<template>
    <taskBoxBlock class="bl-box">

        <taskBoxHeader>
           
        
            <input v-if="taskForm == true" v-on:keyup.enter="onTaskEnter" ref="inp" v-model="this.form.text"  type="text" placeholder="New task" >
           
            <ttl v-else >{{ box.title }}</ttl> 

            <DropDown image="/images/dots.png" size="24">
                <a class="wh-box" @click="toggleTaskForm()">Add Task</a>
                <a class="wh-box" @click="delete_taskbox(id)">Remove</a>
            </DropDown>
        </taskBoxHeader>

        <BaseLine />
        
     
        <draggable 
        class="taskBoxList"
        ghost-class="ghost"
        v-model="box.tasks" 
        @change="orderChanged"
        :group="{ name: 'tasks', pull: true, put: true }"
        :animation="200"
        >

        <template #item="{element, index} ">
            <task class="bl-box main-border" v-bind:class="{ 'complete' : element.done == true, 'planed' : element.planed_at != null && element.done != true }" >
                <txt>{{element.text}}</txt>
                <task_acts>
                    <ImageButton @click="delete_task(element, index)" image="/images/cross.png" size="18"/>
                    <ImageButton @click="complite_task(element, index)" image="/images/check.png" size="18"/>
                </task_acts>
            </task> 
        </template>

        </draggable>
                
         

    </taskBoxBlock>
</template>


<style>
    

    .ghost {
        opacity: 0.5;
        background: #c8ebfb;
    }


   taskBoxBlock {
    box-shadow: 0px 1px 8px 1px rgba(255, 255, 255, 0.5);
    /* background-color: rgb(50, 50, 50); */
    display: flex;
    flex-direction: column;
    border-radius: 10px;
    width: 300px;
    margin-right: 20px;
    margin-top: 26px;
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
