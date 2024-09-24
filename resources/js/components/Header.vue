



<script>
	import { defineComponent } from 'vue';
	
	import BaseLine from '@/components/BaseLine.vue';
	import DropDown from './DropDown.vue';
   
	export default defineComponent({
		components: {BaseLine, DropDown},
		setup() {
			return {};
		},
	});
</script>


<template>
	<header>
		<ttl>TaskToDo</ttl>
		<controls>
			<slot />

			<DropDown image="/images/dots.png" size="18">
				<!-- <a class="wh-box" href="https://discord.gg/Uwe8wxEt"><img src="/images/dis.png" width="22" />Discord</a>
				<a class="wh-box" href="https://www.donationalerts.com/r/some1think"><img src="/images/energy.png" width="22" />Donate</a> -->
				<a class="wh-box" href=""><img src="/images/ytb.png" width="22" />Showcase</a>
			</DropDown>
		</controls>
		
	</header>
	<BaseLine/>
</template>

<style>

	header{
		display: flex;
		width: 100%;
		max-width: 100%;
		flex-direction: center;
		align-items: center;
		justify-content: space-between;
		flex-direction: row;

		
		controls{
			display: flex;
			margin-right: 5px;
			align-items: center;

		
		}
	
	}
	
</style>