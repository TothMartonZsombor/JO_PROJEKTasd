<template>
  <div class="mt-5">
    <h2 class="text-center retro-title mb-4">Tárgyak kezelése</h2>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
      <div class="col" v-for="item in items" :key="item.id">
        <div class="card h-100 shadow retro-card">
          <img v-if="item.image_path" :src="getImageUrl(item.image_path)" class="card-img-top" :alt="item.name">
          <div class="card-body text-center">
            <h5 class="card-title">{{ item.name }}</h5>
            <p class="card-text">{{ item.story }}</p>
            <p class="text-muted">Év: {{ item.year }}</p>
            <button class="btn btn-danger btn-sm mt-2" @click="deleteItem(item.id)">Törlés</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const items = ref([])

const fetchItems = async () => {
  try {
    const response = await axios.get('http://localhost:8000/api/items')
    items.value = response.data
  } catch (err) {
    console.error(err)
  }
}

const deleteItem = async (id) => {
  if (!confirm('Biztosan törlöd a tárgyat?')) return
  try {
    await axios.delete(`http://localhost:8000/api/items/${id}`)
    fetchItems()
  } catch (err) {
    console.error(err)
  }
}

onMounted(fetchItems)

function getImageUrl(path) {
  return 'http://localhost:8000/' + path
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
