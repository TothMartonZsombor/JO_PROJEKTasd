<template>
  <div class="container py-5">
    <h1 class="text-center retro-title mb-4">Új tárgy feltöltése</h1>
    <form @submit.prevent="submit">
      <div class="mb-3">
        <label class="form-label">Név</label>
        <input v-model="form.name" class="form-control" required />
      </div>
      <div class="mb-3">
        <label class="form-label">Téma</label>
        <select v-model="form.theme" class="form-select" required>
          <option value="" disabled>Válassz témát</option>
          <option v-for="t in themes" :key="t" :value="t">{{ t }}</option>
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">Év</label>
        <input v-model="form.year" type="number" class="form-control" required />
      </div>
      <div class="mb-3">
        <label class="form-label">Történet</label>
        <textarea v-model="form.story" class="form-control" rows="3" required></textarea>
      </div>
      <div class="mb-3">
        <label class="form-label">Kép</label>
        <input type="file" @change="onFileChange" class="form-control" required />
      </div>
      <button class="btn btn-primary">Feltöltés</button>
    </form>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const themes = ref([])
const form = ref({
  name: '',
  theme: '',
  year: '',
  story: '',
  image: null
})

onMounted(async () => {
  try {
    const res = await axios.get('http://museumedu.infinityfreeapp.com/api/themes')
    themes.value = res.data
  } catch (e) {
    console.error('Hiba a témák lekérésekor:', e)
  }
})

function onFileChange(e) {
  form.value.image = e.target.files[0]
}

async function submit() {
  const data = new FormData()
  data.append('name', form.value.name)
  data.append('theme', form.value.theme)
  data.append('year', form.value.year)
  data.append('story', form.value.story)
  data.append('image', form.value.image)

  try {
    await axios.post(
      'http://museumedu.infinityfreeapp.com/api/items',
      data,
      { headers: { 'Content-Type': 'multipart/form-data' } }
    )
    alert('Sikeres feltöltés')
  } catch (e) {
    console.error('Feltöltési hiba:', e)
    alert('Hiba történt a feltöltés során')
  }
}
</script>

<style scoped>
.retro-title {
  font-family: 'Shrikhand', cursive;
}
</style>