<script setup>
import { Handle, Position, useVueFlow } from '@vue-flow/core'
import { NodeToolbar } from '@vue-flow/node-toolbar'
import DropDown from '@/components/DropDown.vue'
import BaseLine from '@/components/BaseLine.vue'

const props = defineProps(['id', 'data'])

const actions = ['👎', '✋', '👍']

const { updateNodeData } = useVueFlow()
</script>

<template>
    
    <content>

        <taskTitle> 
           
            <txt>{{ data.label }}</txt>

            <DropDown image="/images/dots.png" size="18">
				<a class="wh-box" href=""><img src="/images/ytb.png" width="22" />Showcase</a>
			</DropDown>

       </taskTitle>
       
        
        <description>
            <BaseLine />

            <txt>
                "Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, 
                totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta 
                sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia 
                consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem 
                ipsum quia dolor sit amet,
            </txt>
        </description>
         
       
    </content>
    
  
    
    
    <Handle type="target" :position="Position.Left" />
    <Handle type="source" :position="Position.Right" />
</template>

<style>

    .vue-flow__node {
        background-color: rgba(34, 34, 34, 0.5);
        padding: 10px;
        border-radius: 8px;
        box-shadow: 0px 1px 8px 1px rgba(255, 255, 255, 0.2);
    }
    .vue-flow__node.selected {
        box-shadow: 0px 1px 8px 1px rgba(255, 255, 255, 0.8);
    }

    content{
        display: flex;
        flex-direction: column;
        align-items: center;
        max-width: 300px;
        width: 300px;
        
        taskTitle {
            width: 100%;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
        }

        
        
        
        description {
            width: 100%;
            flex-direction: column;

            baseBox {
                padding-top: 4px;
                padding-bottom: 4px;
                width: 5%;
                transition: width 1s;
            }

            

            txt {
                
                display: none;
                transition: all 1s ease-out;
            }
        }


        description:hover {

            baseBox {
                transition: width 1s;
                width: 100%;
            }

            txt {
                display: flex;
                transition: all 1s ease-out;
            }
        }
       
    }

</style>