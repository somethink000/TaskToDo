
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

        <slot />
    
    </taskBox>
</template>


<style>
   
   taskBox {
   
    display: flex;
    flex-direction: column;
    border-radius: 10px;
    padding: 10px;
    width: 100%;
    height: 100%;
    overflow: auto;
    -ms-overflow-style: none;
    scrollbar-width: none;

    taskBox::-webkit-scrollbar {
        display: none;
    }

    dateBox {
        display: flex;
        flex-direction: column;
        border-radius: 10px;
        margin-top: 10px;
        width: 100%;
        

        .dateTasksList{
            display: flex;
            min-height: 60px;
        }
    }

    }
   
</style>
