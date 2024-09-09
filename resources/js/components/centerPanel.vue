
<script>
	import { defineComponent } from 'vue';

	export default defineComponent({

		components: {},

        data: () => ({
            
        }),
        methods: {

		},
        
	});
</script>


<template>

    <centerBox>
        <frBox class="main-border bl-box">

                <slot />
               
        </frBox>
    </centerBox>
</template>

<style>
    
    @media screen and (max-width: 600px) {
        centerBox{
            padding: none;
            border-radius: none;
            width: 100%;

            frBox.main-border{
                border: none;
            }

            frBox{
                padding: none;
                width: 100%;
                height: 100%;
            }
        }
    }

    centerBox{
        display: flex;
        position: absolute;
        width: 100%;
        height: 100%;
        background-color: rgba(20, 20, 20, 0.3);
        background-size: 100%; 
        background-repeat: repeat-y;
        backdrop-filter: blur(5px);
        justify-content: center;
        align-items: center;
        

        frBox{
            display: flex;
            border-radius: 10px;
            width: 400px;
            /* height: 400px; */
            padding: 20px;
            flex-direction: column;
            /* justify-content: center; */
            
            form{
                flex-direction: column;
            }

            .colItem{
                flex-direction: row;
                min-height: 32px;
                margin-top: 16px;
                width: 100%;
            }
        }
    
    }

</style>
