
<script lang="ts">
	import { defineComponent, ref } from 'vue';
    import draggable from 'vuedraggable';
    import axios from 'axios';


    import BaseLine from './BaseLine.vue';
    import TaskComponent from './TaskComponent.vue';
    import DropDown from './DropDown.vue';
    import ImageButton from './ImageButton.vue';



	export default defineComponent({

        props: {title: String, id: String, setTasks: Array},
		components: {BaseLine, TaskComponent, DropDown, ImageButton, draggable},
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
						// console.log(res.data);
                        this.toggleTaskForm();

					} else {
						// console.log(res.data);
					}
				})
			},
          
            // updateSort(){
                
            //     axios.patch('/api/tasks' + this.instance.id, this.tasks, {
            //         headers: {
            //             "Content-type": "application/json"
            //         }
            //     })
            //     .then(res => {
            //         if (res.data) {
            //             this.$router.push('/blog/' + res.data.id);
            //         } else {
            //             console.log(res.data);
            //             setTimeout(() => {
            //                 this.loading = false;
            //             }, 300);
            //             this.error = true;
            //         }
            //     })
            // },

            log() {
                console.log(this.tasks);
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
        
        <!-- <taskBoxList> -->
        <draggable 
        class="taskBoxList"
        ghost-class="ghost"
        v-model="tasks" 
        @change="log"
        group="people" 
        @start="drag=true" 
        @end="drag=false" 
        item-key="id">
        <template #item="{element}">
            <TaskComponent :text="element.text" />
        </template>
        </draggable>
                
            
        <!-- </taskBoxList> -->

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


        .taskBoxList {
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
