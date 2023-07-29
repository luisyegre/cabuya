<script setup>
import Icon from '@/Icons/Icon.vue';
import { defineProps } from 'vue';
const { icon } = defineProps({ icon: String })
</script>
<template>
	<li class="flex ">
		<icon :name="icon" />
		<span>
			<slot></slot>
		</span>
	</li>
</template>