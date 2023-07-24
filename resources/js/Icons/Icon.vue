<script setup>
import { computed, defineAsyncComponent, defineProps } from 'vue';
const props = defineProps({
	name:String,
	color:String,
	bgColor:String,
})

const iconload = computed(
	()=>defineAsyncComponent(
		()=> import(`./${(props.name||'Bell')}.vue`)
	)
)

</script>
<template>
	<b class="icon">
		<iconload :color="color" />
	</b>
</template>
<style>
.icon {
	height: fit-content;
	display: grid;
}
</style>