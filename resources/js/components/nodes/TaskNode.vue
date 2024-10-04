<script setup>
import { Handle, Position, useVueFlow } from '@vue-flow/core'
import { NodeToolbar } from '@vue-flow/node-toolbar'
import DropDown from '@/components/DropDown.vue'

const props = defineProps(['id', 'data'])

const actions = ['👎', '✋', '👍']

const { updateNodeData } = useVueFlow()
</script>

<template>
  <!-- <NodeToolbar :is-visible="data.toolbarVisible" :position="data.toolbarPosition">
    <button
      v-for="action of actions"
      :key="action"
      type="button"
      :class="{ selected: action === data.action }"
      @click="updateNodeData(props.id, { action })"
    >
      {{ action }}
    </button>
  </NodeToolbar> -->
    <DropDown image="/images/dots.png" size="18">
        <a class="wh-box" href=""><img src="/images/ytb.png" width="22" />Showcase</a>
	</DropDown>

    <!-- <DropDown> 
        <div class="dropbtn">
            {{ data.label }}
        </div>
        <div class="dropdown-content">
            <a class="wh-box" href=""><img src="/images/ytb.png" width="22" />Showcase</a>
        </div>
    </DropDown> -->
  <div>
    {{ data.label }}
  </div>

  <Handle type="target" :position="Position.Left" />
  <Handle type="source" :position="Position.Right" />
</template>

<style>
    DropDown {
        width: 10px;
        height: 10px;
    }
</style>