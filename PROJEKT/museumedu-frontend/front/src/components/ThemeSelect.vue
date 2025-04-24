<template>
  <div class="container py-5">
    <h1 class="text-center retro-title mb-4">Válassz témát</h1>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
      <div class="col" v-for="theme in themes" :key="theme.id">
        <div class="card h-100 shadow retro-card" @click="selectTheme(theme.name)" style="cursor:pointer;">
          <img :src="getImageUrl(theme.image)" class="card-img-top" :alt="theme.name">
          <div class="card-body text-center">
            <h5 class="card-title">{{ theme.name }}</h5>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'

const themes = ref([])
const router = useRouter()

onMounted(async () => {
  try {
    const response = await axios.get('http://localhost:8000/api/themes')
    themes.value = response.data
  } catch (error) {
    console.error("Nem sikerült betölteni a témákat:", error)
  }
})

function getImageUrl(filename) {
  return 'http://localhost:8000/items/' + filename
}

function selectTheme(name) {
  router.push(`/theme/${name}`)
}
</script>

<style scoped>
.retro-title {
  font-family: 'Shrikhand', cursive;
  font-size: 2.5rem;
  color: #6c1e1e;
}
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
