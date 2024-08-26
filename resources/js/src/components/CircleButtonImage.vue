
<script lang="ts">
	import { defineComponent } from 'vue';

	export default defineComponent({

        
        props: ['title', 'image'],
		components: {},
		setup() {
            
			return {};
		},
	});
</script>


<template>

	<button class="add_button bl-box main-border">
        <img :src="image" width="32" />
        <txt class="txt">{{title}}</txt>
    </button>
   
</template>

<style>
   
    button {
        
        justify-content: center;
        align-items: center;
        border-radius: 20px;
        padding: 2px;
        margin: 6px;
        background-color: rgb(50, 50, 50);
    }
    button:hover {
        background-color: rgb(100, 100, 100);
    }
    button:active {
        background-color: rgb(150, 150, 150);
    }

</style>
