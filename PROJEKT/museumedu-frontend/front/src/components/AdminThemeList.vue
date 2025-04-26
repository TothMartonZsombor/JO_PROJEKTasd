<template>
  <div class="mt-5">
    <h2 class="text-center retro-title mb-4">Témák kezelése</h2>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
      <div class="col" v-for="theme in themes" :key="theme.id">
        <div class="card h-100 shadow retro-card">
          <img :src="getImageUrl(theme.image)" class="card-img-top" :alt="theme.name">
          <div class="card-body text-center">
            <h5 class="card-title">{{ theme.name }}</h5>
            <button class="btn btn-danger btn-sm mt-2" @click="deleteTheme(theme.id)">Törlés</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const themes = ref([])

const fetchThemes = async () => {
  try {
    const response = await axios.get('http://localhost:8000/api/themes')
    themes.value = response.data
  } catch (err) {
    console.error(err)
  }
}

const deleteTheme = async (id) => {
  if (!confirm('Biztosan törlöd a témát?')) return
  try {
    await axios.delete(`http://localhost:8000/api/themes/${id}`)
    fetchThemes()
  } catch (err) {
    console.error(err)
  }
}

onMounted(fetchThemes)

function getImageUrl(filename) {
  return 'http://localhost:8000/items/' + filename
}
</script>

<style scoped>
.retro-card {
  border: 2px solid #e3dccc;
  border-radius: 16px;
  transition: transform 0.2s;
}
.retro-card:hover {
  transform: scale(1.03);
}
.card-img-top {
  object-fit: cover;
  height: 200px;
}
</style>
