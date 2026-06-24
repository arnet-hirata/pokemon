import axios from 'axios'

export const searchProducts = (name) => {
    return axios.get('http://127.0.0.1:8000/api/products', {
        params: {
            name: name
        }
    })
}