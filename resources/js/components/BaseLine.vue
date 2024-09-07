
<script>
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
            background-color: rgba(255, 255, 255, 0.5);
            box-shadow: 0px 1px 8px 1px rgba(255, 255, 255, 0.5);
        }
    }

</style>
