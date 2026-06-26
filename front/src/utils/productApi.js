export const searchProducts = async (name) => {
    const response = await fetch(
        'http://127.0.0.1:8000/api/products/search?name=${encodeURIComponent(name)}'
    )

    return await response.json()
}

const API_URL = 'http://127.0.0.1:8000/api/admin/products';

// 一覧
export const gethProducts = async () => {
    const response = await fetch(API_URL);

    if (!response.ok) {
        throw new Error('商品一覧の取得に失敗しました');
    }
    return await response.json()
};

// 詳細
export const gethProduct = async (id) => {
    const response = await fetch('${API_URL}/${id}');

    if (!response.ok) {
        throw new Error('取得失敗');
    }
    return await response.json()
};

// 登録
export const createProduct = async (formData) => {
    const response = await fetch(API_URL,
        {
            method: 'POST',
            body: formData
        });

    return await response.json()
};

// 編集
export const updateProduct = async (id, formData) => {
    formData.append('_method', 'PUT');

    const response = await fetch('${API_URL}/${id}', {
        method: 'POST',
        body: formData
    });

    return await response.json()
};

// 削除
export const deleteProduct = async (id) => {
    const response = await fetch('${API_URL}/${id}', {
        method: 'DELETE'
    });

    return await response.json()
};
