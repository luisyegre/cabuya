<script setup>
import { computed } from 'vue';
import Bars from './Bars.vue';
import Bell from './Bell.vue';
import Close from './Close.vue';
import Heart from './Heart.vue';
import HeartCrack from './HeartCrack.vue';
import Home from './Home.vue';
import LeftArrow from './LeftArrow.vue';
import Magnify from './Magnify.vue';
import Message from './Message.vue';
import News from './News.vue';
import Profile from './Profile.vue';
import Write from './Write.vue';

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
const iconsload = {
	Bars,
	Bell,
	Close,
	Heart,
	HeartCrack,
	Home,
	LeftArrow,
	Magnify,
	Message,
	News,
	Profile,
	Write,

}
</script>
<template>
	<b :class="'icon ' + customClass">
		<component :is="iconsload[name]" />
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