<script setup>
import { BaseEdge, EdgeLabelRenderer, getBezierPath, useVueFlow } from '@vue-flow/core'
import { computed } from 'vue'

import DropDown from '@/components/DropDown.vue'


const props = defineProps({
  id: {
    type: String,
    required: true,
  },
  sourceX: {
    type: Number,
    required: true,
  },
  sourceY: {
    type: Number,
    required: true,
  },
  targetX: {
    type: Number,
    required: true,
  },
  targetY: {
    type: Number,
    required: true,
  },
  sourcePosition: {
    type: String,
    required: true,
  },
  targetPosition: {
    type: String,
    required: true,
  },
  markerEnd: {
    type: String,
    required: false,
  },
  style: {
    type: Object,
    required: false,
  },
})


const { removeEdges } = useVueFlow()

const path = computed(() => getBezierPath(props))

function Remove() {

    axios.delete('/api/edges/' + props.id)
    .then(res => {
        removeEdges(props.id)
    })

    
}

</script>

<script>
export default {
  inheritAttrs: false,
}
</script>

<template>
  <!-- You can use the `BaseEdge` component to create your own custom edge more easily -->
  <BaseEdge :id="id" :style="style" :path="path[0]" :marker-end="markerEnd" />

  <!-- Use the `EdgeLabelRenderer` to escape the SVG world of edges and render your own custom label in a `<div>` ctx -->
  <EdgeLabelRenderer>
    <div
      :style="{
        pointerEvents: 'all',
        position: 'absolute',
        transform: `translate(-50%, -50%) translate(${path[1]}px,${path[2]}px)`,
      }"
      class="nodrag nopan"
    >

    <DropDown image="/images/cross.png" size="12">
        <a class="wh-box" @click="Remove()">Remove</a>
    </DropDown>
    <!-- <ImageButton @click="toggleEdit()" image="/images/edit.png" size="12" />
      <button class="edgebutton" @click="Remove()">×</button> -->
    </div>
  </EdgeLabelRenderer>
</template>