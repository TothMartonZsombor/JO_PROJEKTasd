
<script setup>
import { ref, onMounted, computed } from 'vue'
import { useRoute } from 'vue-router'
import api from '@/axios'

const items = ref([])
const route = useRoute()
const theme = ref(route.params.theme)

onMounted(async () => {
  try {
    const response = await api.get('/items')
    items.value = response.data
  } catch (error) {
    console.error("Nem sikerült lekérni az itemeket:", error)
  }
})

const filteredItems = computed(() =>
  items.value.filter(i => i.theme === theme.value)
)

function getImageUrl(path) {
  if (!path) return ''
  return 'https://museumedu-laravel.onrender.com/' + path
}
</script>
