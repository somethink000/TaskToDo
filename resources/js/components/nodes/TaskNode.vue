<script setup>
import { useNode, Handle, Position, useVueFlow } from '@vue-flow/core'
import BaseLine from '@/components/BaseLine.vue'
import ImageButton from '@/components/ImageButton.vue'


const props = defineProps(['id', 'data'])
const { findNode, updateNodeData } = useVueFlow()

var inEdit = false;
var inputText = "";
var node = findNode(props.id);

function toggleEdit() {
    inEdit = !inEdit;
    
    updateNodeData(props.id);
}

function onDataTyped() {
    
    node.data = props.data;

    console.log(node);
    return axios.patch('/api/nodes/' + node.id, node, {
        headers: {
            "Content-type": "application/json"
        }
    })
    .then(res => {
        
        console.log(res.data);
        toggleEdit()
    })
    
}


</script>

<template>

   
    <taskActions>

        <ImageButton v-if="inEdit == true" @click="onDataTyped()" image="/images/disk.png" size="12" />

        <ImageButton @click="toggleEdit()" image="/images/edit.png" size="12" />
        <ImageButton image="/images/trash.png" size="12" />
        <ImageButton image="/images/check.png" size="12" />

    </taskActions>


    <content>

        <taskTitle> 

            <input v-if="inEdit == true" v-on:keyup.enter="onDataTyped" ref="inp" v-model="data.label"  type="text" placeholder="Text" >
           
            <txt v-else >{{ data.label }}</txt>

       </taskTitle>
       
        
        <description>
            
            <BaseLine />

            <input v-if="inEdit == true" v-on:keyup.enter="onDataTyped" ref="desc" v-model="data.description"  type="desc" placeholder="Description" >
           
            <txt v-else >{{ data.description }}</txt>

        </description>
         
       
    </content>
    
  
    
    
    <Handle type="target" :position="Position.Left" />
    <Handle type="source" :position="Position.Right" />
</template>

<style>

    taskActions {
        width: 100%;
        display: flex;
        flex-direction: row;
        justify-content: end;

        /* position: absolute;
        right: 0;
        padding-bottom: 100px;
        min-width: 160px;
        flex-direction: row;
        z-index: 2; */
    }

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
        /* width: 300px; */
        
      

        taskTitle {
            width: 100%;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
        }

        
        description { 
            width: 100%;
        }
        
        /* description {
            width: 10%;
            flex-direction: column;
            transition: width 0.5s;

            baseBox {
                padding-top: 4px;
                
                width: 100%;
                
            }

            txt {
                max-height: 0px;
                transition: 0.5s max-height ease;
                overflow: hidden;
            }
        }


        description:hover {
            transition: width 1s;
            width: 100%;


            txt {
                
                max-height: 200px;
            }
        } */
       
    }

</style>