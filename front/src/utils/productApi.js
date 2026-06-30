export const searchProducts = async (name) => {
    const response = await fetch(
        'http://127.0.0.1:8000/api/products/search?name=${encodeURIComponent(name)}'
    )

    return await response.json()
}

const API_URL = 'http://127.0.0.1:8000/api/admin/products';

// 一覧
export const gethProducts = async () => {
    const token = localStorage.getItem('token')
    const response = await fetch(API_URL, {
        headers: {
            'Authorization': token ? `Bearer ${token}` : '',
            'Accept': 'application/json',
        }
    });

    if (!response.ok) {
        throw new Error('商品一覧の取得に失敗しました');
    }
    return await response.json()
};

// 詳細
export const getProduct = async (id) => {
    const token = localStorage.getItem('token')
    const response = await fetch(`http://127.0.0.1:8000/api/admin/products/${id}`, {
        headers: {
            'Authorization': token ? `Bearer ${token}` : '',
            'Content-Type': 'application/json',
            'Accept': 'application/json',
        }
    });
    console.log(response.status);
    console.log(response);


    // if (!response.ok) {
    //     throw new Error('取得失敗');
    // }
    return await response.json()
};

export const getProductDetail = async (id) => {
    const token = localStorage.getItem('token')
    const response = await fetch(`http://127.0.0.1:8000/api/products/productdetail/${id}`, {
        headers: {
            'Authorization': token ? `Bearer ${token}` : '',
            'Content-Type': 'application/json',
            'Accept': 'application/json',
        }
    });
    console.log(response.status);
    console.log(response);


    // if (!response.ok) {
    //     throw new Error('取得失敗');
    // }
    return await response.json()
};

// 登録
export const createProduct = async (formData) => {
    const token = localStorage.getItem('token')
    const response = await fetch(API_URL,
        {
            method: 'POST',
            headers: {
                'Authorization': token ? `Bearer ${token}` : '',
                'Accept': 'application/json',
            },
            body: formData
        });

    return await response.json()
};

// 編集
export const updateProduct = async (id, formData) => {
    const token = localStorage.getItem('token')
    formData.append('_method', 'PUT');

    const response = await fetch(`${API_URL}/${id}`, {

        method: 'POST',
        headers: {
            'Authorization': token ? `Bearer ${token}` : '',
            'Accept': 'application/json',
        },
        body: formData
    });
    if (!response.ok) {
        throw new Error('更新失敗');
    }
    return await response.json()
};

// 削除
export const deleteProduct = async (id) => {
    const token = localStorage.getItem('token')
    const response = await fetch(`${API_URL}/${id}`, {
        method: 'DELETE',
        headers: {
            'Authorization': token ? `Bearer ${token}` : '',
            'Accept': 'application/json'
        },
    });
    if (!response.ok) {
        throw new Error('削除に失敗しました');
    }
    return await response.json()
};

// export const changeStock = async (id, data) => {
//     const token = localStorage.getItem('token')

//     const response = await fetch(`${API_URL}/${id}/stock`, {
//         method: 'POST',
//         headers: {
//             'Authorization': token ? `Bearer ${token}` : '',
//             'Accept': 'application/json',
//             'Content-Type': 'application/json'
//         },
//         body: JSON.stringify(data)
//     });
//     if (!response.ok) {
//         throw new Error('在庫更新失敗');
//     }
//     return await response.json();
// };