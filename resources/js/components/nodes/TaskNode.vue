<script setup>
import { useNode, Handle, Position, useVueFlow } from '@vue-flow/core'
import BaseLine from '@/components/BaseLine.vue'
import ImageButton from '@/components/ImageButton.vue'


const props = defineProps(['id', 'data'])
const { getConnectedEdges, removeNodes, findNode, updateNodeData } = useVueFlow()

var descShowed = false;
var inEdit = false;
var node = findNode(props.id);
var nodeEdges = getConnectedEdges(props.id);


function toggleEdit() {
    inEdit = !inEdit;
    
    updateNodeData(props.id);
}

function toggleDescription() {
    descShowed = !descShowed;
    
    updateNodeData(props.id);
}


function onDataTyped() {
    
    node.data = props.data;

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

function Remove() {

    for (var i = 0; i < nodeEdges.length; ++i) {

        let edge = nodeEdges[i];
        
        axios.delete('/api/edges/' + edge.id)
        .then(res => {
            
        })
    }

    axios.delete('/api/nodes/' + props.id)
    .then(res => {
        removeNodes(props.id);
    })

    
}

function Done() {

    node.done = !node.done

    return axios.patch('/api/nodes/' + node.id, node, {
        headers: {
            "Content-type": "application/json"
        }
    })
    .then(res => {
      
    })
    
}


</script>

<template>

   
    <taskActions>

        <ImageButton v-if="inEdit == true" @click="onDataTyped()" image="/images/disk.png" size="12" />

        <ImageButton @click="toggleEdit()" image="/images/edit.png" size="12" />
        <ImageButton @click="Remove()" image="/images/trash.png" size="12" />
        <ImageButton @click="Done()" image="/images/check.png" size="12" />

    </taskActions>


    <content v-bind:class="{ 'done' : node.done == true }">

        <taskTitle class="boxed"> 

            <input v-if="inEdit == true" v-on:keyup.enter="onDataTyped" ref="inp" v-model="data.label"  type="text" placeholder="Text" >
           
            <txt v-else >{{ data.label }}</txt>

            <dropDownLine @click="toggleDescription()">
                <button v-bind:class="{ 'showed' : descShowed == true }" ></button>
            </dropDownLine>

        </taskTitle>
       
         

        <description v-bind:class="{ 'showed' : descShowed == true }" class="boxed">

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

        button {
            background-color: rgba(34, 34, 34, 0.5);
        }
    }


    .boxed{
        background-color: rgba(34, 34, 34, 0.5);
        border-radius: 8px;
        box-shadow: 0px 1px 8px 1px rgba(255, 255, 255, 0.2);

    }


    .vue-flow__node {
        
        padding: 10px;
       
    }
    .vue-flow__node.selected {

        .boxed {
            box-shadow: 0px 1px 8px 1px rgba(255, 255, 255, 0.8);

        }
    }
    

    .done {
        .boxed {
            background-color: rgba(34, 34, 34, 0.8);
            color: rgb(105, 105, 105);
        }
        
    }

    content{
        display: flex;
        flex-direction: column;
        align-items: center;
        max-width: 300px;
       

        taskTitle {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            
            dropDownLine {
                display: flex;
                justify-content: center;
                align-items: center;
                width: 100%;
                padding-top: 4px;
                padding-bottom: 6px;
                
               
                button {
                    display: flex;
                    padding: 0;
                    width: 10%;
                    height: 1px;
                    background-color: rgba(255, 255, 255, 0.5);
                    box-shadow: 0px 1px 4px 1px rgba(255, 255, 255, 0.5);
                    transition: width 0.5s;
                }
                button.showed {
                    transition: width 0.5s;
                    width: 100%;
                }

            }

            dropDownLine:hover {
                button {
                    box-shadow: 0px 1px 6px 1px rgba(255, 255, 255, 0.8);
                }
            }
        }

        
        description { 
            display: none;
            /* margin-top: 0;
            translate: all 0.5s; */
        }
        
        description.showed {
            display: flex;
            margin-top: 12px;
            /* translate: all 0.5s; */
        }
       
    }

</style>