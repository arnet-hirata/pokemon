const API_BASE_URL = 'http://localhost:8000/api'

export const apiClient = {
    async get(endpoint) {
        const token = localStorage.getItem('token')
        const response = await fetch(`${API_BASE_URL}${endpoint}`, {
            headers: {
                'Authorization': token ? `Bearer ${token}` : '',
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            }
        })
        // 空ボディ（204など）でも落ちないように、一度テキストで受けてから判定
        const text = await response.text()
        const data = text ? JSON.parse(text) : null
        if (!response.ok) throw data
        return data
    },

    async post(endpoint, data) {
        const token = localStorage.getItem('token')
        const response = await fetch(`${API_BASE_URL}${endpoint}`, {
            method: 'POST',
            headers: {
                'Authorization': token ? `Bearer ${token}` : '',
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify(data)
        })
        const text = await response.text()
        const responseData = text ? JSON.parse(text) : null
        if (!response.ok) throw responseData
        return responseData
    },

    async put(endpoint, data) {
        const token = localStorage.getItem('token')
        const response = await fetch(`${API_BASE_URL}${endpoint}`, {
            method: 'PUT',
            headers: {
                'Authorization': token ? `Bearer ${token}` : '',
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify(data)
        })
        const text = await response.text()
        const responseData = text ? JSON.parse(text) : null
        if (!response.ok) throw responseData
        return responseData
    },

    async delete(endpoint) {
        const token = localStorage.getItem('token')
        const response = await fetch(`${API_BASE_URL}${endpoint}`, {
            method: 'DELETE',
            headers: {
                'Authorization': token ? `Bearer ${token}` : '',
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            }
        })
        // DELETE は 204（ボディ無し）で返ることが多いので、ここの対応が効く
        const text = await response.text()
        const responseData = text ? JSON.parse(text) : null
        if (!response.ok) throw responseData
        return responseData
    }
}
