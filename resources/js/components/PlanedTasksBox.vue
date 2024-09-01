
<script lang="ts">
	import { defineComponent } from 'vue';
    
    import BaseLine from './BaseLine.vue';


	export default defineComponent({

		components: {BaseLine},
		setup() {
            
			return {};
		},
	});
</script>


<template>
    <taskBox>

        <taskBoxHeader>
           
        </taskBoxHeader>

        <taskBoxList>

        </taskBoxList>

    </taskBox>
</template>


<style>
   
   taskBox {
   
    display: flex;
    flex-direction: column;
    border-radius: 10px;
    width: 100%;
    height: 100%;

        taskBoxHeader {
            display: flex;
            padding: 8px;
            justify-content: space-between;
            align-items: center;
        }


        taskBoxList {
            display: flex;
            width: 100%;
            height: 100%;
            flex-direction: column;
            overflow: auto;
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        taskBoxList::-webkit-scrollbar {
            display: none;
        }

    }


    taskBox.dragging {
        opacity: 0.1;
    }
   
</style>
