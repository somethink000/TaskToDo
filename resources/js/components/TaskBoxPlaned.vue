


<script>
	import { defineComponent } from 'vue';
    import draggable from 'vuedraggable';
    import axios from 'axios';
    import { useTodoStore } from '@/stores/todo.js'
	import { mapActions, mapStores } from 'pinia'
    import moment from "moment";

    import BaseLine from '@/components/BaseLine.vue';
    import ImageButton from './ImageButton.vue';
    import DropDown from './DropDown.vue';
    
	export default defineComponent({
        
        props: {date: String},
		components: {draggable, BaseLine, ImageButton, DropDown},
        data: (instance) => ({
            dateString: moment(instance.date).format('dddd-DD-MM-YYYY'),
            isToday: instance.date == moment().format('YYYY-MM-DD')
		}),
        computed: {
            ...mapStores(useTodoStore),

            datebox() {return this.todoStore?.getDateBox(this.date)},
            boxes() {return this.todoStore?.currentBoxes},
        },
        mounted() {
            
            
		},
		methods: {

            ...mapActions(useTodoStore, [
                'update_task',
                'unpin_task',
            ]),
    
           


			dateChanged(item) { 
               
                if (item.added != null ){
                    var task = item.added.element;
                    task.planed_at = this.date;
                    task.done = false;
                    this.update_task(task);
                }
            },


            compliteTask(task, index) {
                task.done = !task.done;

                this.update_task(task);
            },

		}
	});
</script>


<template>

    <dateBox  v-bind:class="{ 'today' : isToday == true }" >
        <!-- moment(this.date).format('dddd-YYYY-MM-DD') -->
        <txt>{{ dateString }}</txt>


        <draggable 
            class="dateTasksList"
            ghost-class="ghost"
            v-model="datebox.tasks" 				
            :group="{ name: 'tasks', pull: true, put: true}", 
            @change="dateChanged"
            item-key="id"
            :animation="200"
            >
            
            <template #item="{element, index}">
                <task v-if="boxes.get(element.taskbox_id) != null" class="bl-box main-border" v-bind:class="{ 'complete' : element.done == true, 'dedlined' : element.dedline == true && element.done == false}" >
                    <txt class="taskcat">{{ boxes.get(element.taskbox_id).title.slice(0, 4)}}</txt>
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
        display: flex;
        background-color: rgba(29, 0, 0, 0.2);
        min-height: 400px;
        box-shadow: 0px 1px 8px 1px rgba(255, 255, 255, 0.5);
    }
 
   
    dateBox {
        display: flex;
        flex-direction: column;
        width: 100%;
        margin-top: 26px;
        flex-shrink: 0;
        padding-bottom: 10px;
        /* border-top: 1px solid rgb(100, 100, 100); */
        /* border-bottom: 1px solid rgb(100, 100, 100); */
        box-shadow: 0px 1px 8px 1px rgba(255, 255, 255, 0.5);

        .dateTasksList{
            display: flex;
            min-height: 60px;
            height: 100%;
            align-items: center;
            flex-direction: column;
            padding: 2px;


            task.dedlined {
                background-color: rgba(107, 0, 0, 0.5);
            }

            task {
                display: flex;
                justify-content: space-between;
                align-items: center;
                border-radius: 10px;
                width: 96%;
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
