<template>
  <div class="container py-5">
    <h1 class="text-center retro-title mb-4">Témák</h1>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
      <div class="col" v-for="t in themes" :key="t">
        <router-link :to="{ name: 'items', params: { theme: t } }">
          <div class="card h-100 shadow retro-card text-center p-3">
            <img
              :src="getImageUrl(t.image_path || t.image)"
              class="img-fluid mb-2"
              alt="téma kép"
            />
            <h5 class="card-title">{{ t.name || t }}</h5>
          </div>
        </router-link>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const themes = ref([])

onMounted(async () => {
  try {
    const res = await axios.get('http://museumedu.infinityfreeapp.com/api/themes')
    themes.value = res.data
  } catch (e) {
    console.error('Nem sikerült lekérni a témákat:', e)
  }
})

function getImageUrl(path) {
  if (!path) return ''
  return `http://museumedu.infinityfreeapp.com/${path}`
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
}
</style>