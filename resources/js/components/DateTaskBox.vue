


<script>
	import { defineComponent } from 'vue';
    import draggable from 'vuedraggable';
    import axios from 'axios';
    
    import BaseLine from '@/components/BaseLine.vue';

	export default defineComponent({

        props: {date: String, setTasks: Array},
		components: {draggable, BaseLine},
        data: (instance) => ({
			
            tasks: instance.setTasks,
		}),

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
                    this.updateTask(task);
                }
            },
		}
	});
</script>


<template>

    <dateBox class="main-border bl-box" >

        <txt>{{ date }}</txt>

        <BaseLine />

        <draggable 
            class="dateTasksList"
            ghost-class="ghost"
            v-model="tasks" 				
            :group="{ name: 'tasks', pull: false, put: true}", 
            @change="dateChanged"
            item-key="id">

            <template #item="{element, index}">
                <task class="bl-box main-border" v-bind:class="{ 'complete' : element.done == true}">
                    <txt>{{element.text}}</txt>
                    <task_acts>
                        <!-- <ImageButton @click="deleteTask(element.id, index)" image="/images/cross.png" size="16"/>
                        <ImageButton @click="compliteTask(element, index)" image="/images/check.png" size="16"/> -->
                    </task_acts>
                </task> 
            </template>

        </draggable>
    </dateBox>
                
    
</template>


<style>
   
    dateBox {
        display: flex;
        flex-direction: column;
        border-radius: 10px;
        margin-top: 10px;
        width: 100%;
        

        .dateTasksList{
            display: flex;
            min-height: 60px;
            align-items: center;
            flex-direction: column;
            padding: 2px;

            task {
                display: flex;
                justify-content: space-between;
                align-items: center;
                border-radius: 10px;
                width: 94%;
                margin-top: 12px;
                padding: 2px;

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
