import axios from 'axios'

const api = axios.create({
  baseURL: 'https://jo-projektasd-backend2.onrender.com/api',
})

export default api
