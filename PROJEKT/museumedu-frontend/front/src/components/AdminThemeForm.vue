<template>
  <div class="container py-5">
    <h1 class="text-center retro-title mb-4">Új téma hozzáadása</h1>
    <form @submit.prevent="submitTheme">
      <div class="mb-3">
        <label class="form-label">Téma neve</label>
        <input v-model="name" class="form-control" required />
      </div>
      <div class="mb-3">
        <label class="form-label">Téma kép</label>
        <input type="file" @change="onFileChange" class="form-control" required />
      </div>
      <button class="btn btn-primary">Mentés</button>
    </form>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'

const name = ref('')
const image = ref(null)

function onFileChange(e) {
  image.value = e.target.files[0]
}

async function submitTheme() {
  const data = new FormData()
  data.append('name', name.value)
  data.append('image', image.value)

  try {
    await axios.post(
      'http://museumedu.infinityfreeapp.com/api/themes',
      data,
      { headers: { 'Content-Type': 'multipart/form-data' } }
    )
    alert('Téma sikeresen hozzáadva')
  } catch (e) {
    console.error('Hiba a téma mentésekor:', e)
    alert('Téma hozzáadása közben hiba történt')
  }
}
</script>

<style scoped>
.retro-title {
  font-family: 'Shrikhand', cursive;
}
</style>