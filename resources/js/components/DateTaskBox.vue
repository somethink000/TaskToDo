


<script>
	import { defineComponent } from 'vue';
    import draggable from 'vuedraggable';
    import axios from 'axios';
    
    import BaseLine from '@/components/BaseLine.vue';
    import ImageButton from './ImageButton.vue';
    import DropDown from './DropDown.vue';
    
	export default defineComponent({

        props: {date: String, setTasks: Array, boxes: Array},
		components: {draggable, BaseLine, ImageButton, DropDown},
        data: (instance) => ({
 
            tasks: instance.setTasks,
            timeOptions: {
				weekday: 'long',
				year: 'numeric',
				month: 'numeric',
				day: 'numeric',
			},
            isToday: false,
            dateString: new Date(instance.date),
		}),
        mounted() {
            
            this.isToday = this.date == new Date().toLocaleDateString();
            this.dateString = this.dateString.toLocaleDateString(undefined, this.timeOptions)
		},
		methods: {
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
           
			dateChanged(item) { 
               
                if (item.added != null ){
                    var task = item.added.element;
                    task.planed_at = this.date;
                    task.done = false;
                    this.updateTask(task);
                }
            },

            compliteTask(task, index) {
                task.done = !task.done;

                this.updateTask(task);
            },

            unpinTask(task, index) {
               
                task.planed_at = null;
                this.boxes.get(task.taskboxId).tasks.unshift(task);
				this.tasks.splice(index, 1);
                this.updateTask(task);
                // console.log(this.boxes.get(task.taskboxId));
            },
		}
	});
</script>


<template>

    <dateBox  v-bind:class="{ 'today' : isToday == true }" >

        <txt>{{ dateString }}</txt>


        <draggable 
            class="dateTasksList"
            ghost-class="ghost"
            v-model="tasks" 				
            :group="{ name: 'tasks', pull: true, put: true}", 
            @change="dateChanged"
            item-key="id"
            :animation="200"
            >
            
            <template #item="{element, index}">
                <task v-if="boxes.get(element.taskboxId) != null" class="bl-box main-border" v-bind:class="{ 'complete' : element.done == true}" >
                    <txt class="taskcat">{{ boxes.get(element.taskboxId).title.slice(0, 4)}}</txt>
                    <txt class="text">{{element.text}}</txt>
                    <task_acts>          
                        <!-- <a class="bl-box" @click="unpinTask(element, index)"><img src="/images/unpin.png" width="22" />Unpin</a> --> 
                        <ImageButton @click="compliteTask(element, index)" image="/images/check.png" size="18"/>
                    </task_acts>
                </task> 
            </template>

        </draggable>
    </dateBox>
                
    
</template>


<style>

    .today{
        background-color: rgba(29, 0, 0, 0.2);
        min-height: 400px;
        box-shadow: 0px 8px 16px 0px rgba(95, 95, 95, 0.5);
    }
 
   
    dateBox {
        display: flex;
        flex-direction: column;
        width: 100%;
        margin-top: 26px;
        padding-bottom: 10px;
        border-top: 1px solid rgb(100, 100, 100);
        border-bottom: 1px solid rgb(100, 100, 100);

        .dateTasksList{
            display: flex;
            min-height: 60px;
            height: 100%;
            align-items: center;
            flex-direction: column;
            padding: 2px;

            task {
                display: flex;
                justify-content: space-between;
                align-items: center;
                border-radius: 10px;
                width: 98%;
                margin-top: 12px;
                padding: 2px;

                .text{
                    width:80%; word-wrap:break-word; display:inline-block;
                }

                .taskcat {
                    /* color: rgb(100, 100, 100); */
                    border-right: 1px solid rgb(100, 100, 100);
                    text-shadow: 2px 1px 4px white;
                }

                task_acts {
                    display: flex;
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
    }

   
</style>
