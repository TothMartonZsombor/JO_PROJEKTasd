import axios from 'axios'

const api = axios.create({
  baseURL: 'https://museumedu-laravel.onrender.com/api'
})

export default api
