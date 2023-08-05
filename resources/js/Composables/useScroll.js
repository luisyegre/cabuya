import { onMounted, reactive } from 'vue'
export function useScroll(target, callback) {
	const result = reactive({
		nearOfEnd: false,
		position: 0
	})
	onMounted(() => {
		if (target == null) 
			return
		target.value.addEventListener('scroll', (ev) => {
			const scrollTopsInScrollHeight = Math.round(target.value.scrollHeight / target.value.scrollTop)
			result.nearOfEnd = scrollTopsInScrollHeight <= 1
			result.position = target.value.scrollTop
			callback(result)
		})
	})
}