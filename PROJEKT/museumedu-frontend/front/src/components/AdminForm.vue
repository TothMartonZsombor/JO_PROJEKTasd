
<script setup>
import { ref, onMounted } from 'vue'
import api from 'axios'

const name = ref('')
const theme = ref('')
const year = ref('')
const story = ref('')
const image = ref(null)
const themes = ref([])
const success = ref(false)
const error = ref(false)

const fetchThemes = async () => {
  try {
    const response = await api.get('/themes')
    themes.value = response.data
  } catch (err) {
    console.error("Hiba a témák lekérésénél:", err)
  }
}

onMounted(fetchThemes)

const submitItem = async () => {
  const formData = new FormData()
  formData.append('name', name.value)
  formData.append('theme', theme.value)
  formData.append('year', year.value)
  formData.append('story', story.value)
  formData.append('image', image.value)

  try {
    await api.post('/items', formData)
    success.value = true
    error.value = false
  } catch (err) {
    error.value = true
    success.value = false
    console.error("Hiba történt:", err)
  }
}
</script>
