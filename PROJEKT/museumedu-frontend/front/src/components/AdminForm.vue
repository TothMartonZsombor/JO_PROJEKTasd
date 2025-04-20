<script setup>
import { ref, onMounted } from 'vue'
import api from '../axios'

const name = ref('')
const theme = ref('')
const year = ref('')
const story = ref('')
const image = ref(null)
const themes = ref([])
const success = ref(false)
const errorMessage = ref('')

onMounted(async () => {
  try {
    const response = await api.get('/themes')
    themes.value = response.data
  } catch (error) {
    console.error("Hiba a témák lekérésekor:", error)
  }
})

async function submitItem() {
  const formData = new FormData()
  formData.append('name', name.value)
  formData.append('theme', theme.value)
  formData.append('year', year.value)
  formData.append('story', story.value)
  formData.append('image', image.value)

  try {
    await api.post('/items', formData)
    success.value = true
    errorMessage.value = ''
    name.value = ''
    theme.value = ''
    year.value = ''
    story.value = ''
    image.value = null
  } catch (error) {
    console.error("Hiba történt a feltöltés során:", error)
    success.value = false
    errorMessage.value = 'Hiba történt a feltöltés során.'
  }
}
</script>