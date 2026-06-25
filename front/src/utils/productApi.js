export const searchProducts = async(name) => {
    const response = await fetch(
    'http://127.0.0.1:8000/api/products/search?name=${encodeURIComponent(name)}' 
    )

return await response.json()
}