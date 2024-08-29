
<script lang="ts">
	import { defineComponent } from 'vue';
    import ImageButton from './ImageButton.vue';


	export default defineComponent({

        props: ['prefix', 'text'],
		components: {ImageButton},
		setup() {
            
			return {};
		},
	});
</script>


<template>

    <task class="bl-box main-border">
        <txt>{{text}}</txt>
        <task_acts>
            <ImageButton image="/images/cross.png" size="16"/>
            <ImageButton image="/images/check.png" size="16"/>
        </task_acts>
    </task>
</template>

<style>
   
   
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

</style>
