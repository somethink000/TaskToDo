
<script lang="ts">
	import { defineComponent } from 'vue';
    
    import BaseLine from './BaseLine.vue';


	export default defineComponent({

        props: {title: String},
		components: {BaseLine},
		setup() {
            
			return {};
		},
	});
</script>


<template>
    <taskBoxBlock>

        <taskBoxHeader>
            <ttl>{{ title }}</ttl> 
        </taskBoxHeader>

        <BaseLine />

        <taskBoxList>

        </taskBoxList>

    </taskBoxBlock>
</template>


<style lang="scss">
   
   taskBoxBlock {
    background-color: rgb(50, 50, 50);
    display: flex;
    flex-direction: column;
    border-radius: 10px;
    width: 22%;
    margin: 10px;
    max-height: 45vh;


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


    taskBoxBlock.dragging {
        opacity: 0.1;
    }
   
</style>
