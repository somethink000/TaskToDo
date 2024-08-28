
<script lang="ts">
	import { defineComponent } from 'vue';

	export default defineComponent({

		components: {},
		setup() {
            
			return {};
		},
	});
</script>


<template>

    <baseBox><baseLineBox></baseLineBox></baseBox>
   
</template>

<style>
   
    baseBox {
        display: flex;
        width: 100%;
        justify-content: center;
        align-items: center;

        baseLineBox{
            display: flex;
            width: 95%;
            height: 1px;
            background-color: rgb(100, 100, 100);
        }
    }

</style>
