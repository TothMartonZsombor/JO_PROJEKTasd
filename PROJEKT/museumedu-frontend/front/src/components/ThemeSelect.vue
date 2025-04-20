<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import api from '../axios'

const themes = ref([])
const router = useRouter()

onMounted(async () => {
  try {
    const response = await api.get('/themes')
    themes.value = response.data
  } catch (error) {
    console.error("Nem sikerült betölteni a témákat:", error)
  }
})

function getImageUrl(filename) {
  return 'https://museumedu-laravel.onrender.com/items/' + filename
}

function selectTheme(name) {
  router.push(`/theme/${name}`)
}
</script>
