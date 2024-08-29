
<script lang="ts">

	import { defineComponent } from 'vue';
    import ImageButton from './ImageButton.vue';



	export default defineComponent({

		components: {ImageButton},
		
	});
</script>


<template>

   <drpDown>

        <ImageButton  image="/images/dots.png" size="20"/>
      
        <drpDownContent>
            <!-- <slot />
            <a href="#">Delete</a> -->
            <!-- <a href="#" onclick="removeTaskBox(event)">Delete</a>
            <a href="#" onclick="createTaskWindow(event)">NewTask</a> -->
        </drpDownContent>
    </drpDown>
</template>

<style>
  
    drpDown {
    position: relative;
    display: inline-block;


        
        drpDownContent {
            display: none;
            position: absolute;
            background-color: rgb(50, 50, 50);
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 5;
        }
        

        drpDownContent a {
            display: flex;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
        
        drpDownContent a:hover {background-color: rgb(100, 100, 100);}
        
        drpDown:hover drpDownContent {display: block;}
    }
   
</style>
