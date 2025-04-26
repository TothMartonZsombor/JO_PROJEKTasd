<template>
  <div class="container py-5">
    <h1 class="text-center retro-title mb-4">{{ theme }} témájú tárgyak</h1>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
      <div class="col" v-for="item in filteredItems" :key="item.id">
        <div class="card h-100 shadow retro-card">
          <!-- Ha van kép, kattintva kinagyítjuk -->
          <img
            v-if="item.image_path"
            :src="getImageUrl(item.image_path)"
            class="card-img-top"
            :alt="item.name"
            @click="enlargeImage(item.image_path)"
            style="cursor: zoom-in;"
          />
          <div class="card-body">
            <h5 class="card-title">{{ item.name }}</h5>
            <p class="card-text">{{ item.story }}</p>
            <p class="text-muted">Év: {{ item.year }}</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Lightbox overlay -->
    <div v-if="selectedImage" class="overlay" @click="selectedImage = null">
      <img :src="getImageUrl(selectedImage)" class="overlay-image" />
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue'
import { useRoute } from 'vue-router'
import axios from 'axios'

const items = ref([])
const route = useRoute()
const theme = ref(route.params.theme)
const selectedImage = ref(null)

onMounted(async () => {
  try {
    const res = await axios.get('http://localhost:8000/api/items')
    items.value = Array.isArray(res.data)
      ? res.data
      : (res.data.data ?? [])
  } catch (e) {
    console.error('Nem sikerült lekérni az itemeket:', e)
  }
})

const filteredItems = computed(() =>
  Array.isArray(items.value)
    ? items.value.filter(i => i.theme === theme.value)
    : []
)

function getImageUrl(path) {
  if (!path) return ''
  // Hard-code a publikus items könyvtár URL-je:
  return `http://localhost:8000/${path}`
}

function enlargeImage(path) {
  selectedImage.value = path
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
.card-img-top {
  object-fit: cover;
  height: 200px;
}

/* Lightbox overlay */
.overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100vh;
  background: rgba(0,0,0,0.8);
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: zoom-out;
  z-index: 1000;
}
.overlay-image {
  max-width: 90%;
  max-height: 90%;
  box-shadow: 0 0 20px rgba(0,0,0,0.5);
  border-radius: 8px;
}
</style>