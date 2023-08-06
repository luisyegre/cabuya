<script setup>
import { computed, defineAsyncComponent } from 'vue';
const props = defineProps({
	name: String,
	color: String,
	bgColor: String,
	size: String,
	customClass: String
})
const color = computed(() => (
	props.color || 'rgb(var(--bs-primary-rgb))'
))
const iconload = computed(
	() => defineAsyncComponent(
		() => import(`./${(props.name || 'Bell')}.vue`)
	)
)

</script>
<template>
	<b :class="'icon ' + customClass">
		<iconload />
	</b>
</template>
<style>
.icon {
	height: fit-content;
	display: grid;
	font-size: v-bind(size);
	fill: v-bind(color);
}
</style>