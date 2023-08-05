import { ref, toValue, watchEffect } from 'vue'

export function useFetch(url) {
	const data = ref(null)
	const error = ref(null)
	const fetching = ref(false)

	watchEffect(async () => {
		console.log("CAHNGES")
		fetching.value = true
		try {
			const resp = await fetch(toValue(url))
			data.value = await resp.json()
		} catch (err) {
			error.value = err
			console.log(err)
		} finally {
			fetching.value = false
		}
	})
	return { data, error, fetching }
}