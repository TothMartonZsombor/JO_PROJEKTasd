
<template>
  <div class="container py-5">
    <h1 class="text-center retro-title mb-4">Új tárgy hozzáadása</h1>

    <div class="text-end mb-3">
      <button class="btn btn-outline-secondary" @click="goToThemeForm">Témák kezelése és hozzáadása</button>
    </div>

    <div v-if="message" :class="'alert ' + (success ? 'alert-success' : 'alert-danger')">
      {{ message }}
    </div>

    <form @submit.prevent="submitItem" enctype="multipart/form-data">
      <div class="mb-3">
        <label class="form-label">Név</label>
        <input type="text" v-model="form.name" class="form-control" required />
      </div>

      <div class="mb-3">
        <label class="form-label">Téma</label>
        <select v-model="form.theme" class="form-select" required>
          <option disabled value="">Válassz témát</option>
          <option v-for="theme in themes" :key="theme.id" :value="theme.name">
            {{ theme.name }}
          </option>
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">Év</label>
        <input type="number" v-model="form.year" class="form-control" required />
      </div>

      <div class="mb-3">
        <label class="form-label">Történet</label>
        <textarea v-model="form.story" class="form-control" required></textarea>
      </div>

      <div class="mb-3">
        <label class="form-label">Kép feltöltése</label>
        <input type="file" @change="handleFileUpload" class="form-control" required />
      </div>

      <button type="submit" class="btn btn-success">Mentés</button>
    </form>
    <AdminItemList />
  </div>
</template>

<script setup>
import AdminItemList from './AdminItemList.vue'
import { ref, onMounted } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

const form = ref({
  name: '',
  theme: '',
  year: '',
  story: '',
  image: null
})

const themes = ref([])
const message = ref('')
const success = ref(false)
const router = useRouter()

function handleFileUpload(event) {
  form.value.image = event.target.files[0]
}

function goToThemeForm() {
  router.push('/admin/themes')
}

async function submitItem() {
  try {
    const formData = new FormData()
    formData.append('name', form.value.name)
    formData.append('theme', form.value.theme)
    formData.append('year', form.value.year)
    formData.append('story', form.value.story)
    formData.append('image', form.value.image)

    await axios.post('http://localhost:8000/api/items', formData)

    message.value = 'Sikeres feltöltés'
    success.value = true
    form.value = {
      name: '',
      theme: '',
      year: '',
      story: '',
      image: null
    }
  } catch (error) {
    console.error("Hiba történt:", error)
    message.value = 'Hiba történt a feltöltés során.'
    success.value = false
  }
}

onMounted(async () => {
  try {
    const response = await axios.get('http://localhost:8000/api/themes')
    themes.value = response.data
  } catch (error) {
    console.error('Hiba a témák lekérdezésekor:', error)
  }
})
</script>

<style scoped>
.retro-title {
  font-family: 'Shrikhand', cursive;
  font-size: 2.5rem;
  color: #6c1e1e;
}
</style>
