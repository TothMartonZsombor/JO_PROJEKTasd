
<template>
  <div class="container py-5">
    <h2 class="text-center retro-title mb-4">Új téma hozzáadása</h2>

    <div v-if="message" :class="'alert ' + (success ? 'alert-success' : 'alert-danger')">
      {{ message }}
    </div>

    <form @submit.prevent="submitTheme" enctype="multipart/form-data">
      <div class="mb-3">
        <label class="form-label">Téma neve</label>
        <input type="text" v-model="form.name" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Téma képe</label>
        <input type="file" @change="handleFileUpload" class="form-control" required>
      </div>

      <button type="submit" class="btn btn-primary">Téma mentése</button>
    </form>
    <AdminThemeList />
  </div>
</template>

<script setup>
import AdminThemeList from './AdminThemeList.vue'
import { ref } from 'vue'
import axios from 'axios'

const form = ref({
  name: '',
  image: null
})

const message = ref('')
const success = ref(false)

function handleFileUpload(event) {
  form.value.image = event.target.files[0]
}

async function submitTheme() {
  try {
    const formData = new FormData()
    formData.append('name', form.value.name)
    formData.append('image', form.value.image)

    await axios.post('http://localhost:8000/api/themes', formData)
    message.value = 'Sikeresen mentve!'
    success.value = true
    form.value.name = ''
    form.value.image = null
  } catch (error) {
    if (error.response && error.response.status === 422) {
      const errors = error.response.data.errors
      if (errors?.name?.includes('has already been taken')) {
        message.value = 'Ez a téma már létezik!'
      } else {
        message.value = 'Hibás adatbevitel.'
      }
    } else {
      message.value = 'Hiba történt a mentés során.'
    }
    success.value = false
  }
}
</script>

<style scoped>
.retro-title {
  font-family: 'Shrikhand', cursive;
  font-size: 2rem;
  color: #6c1e1e;
}
</style>
