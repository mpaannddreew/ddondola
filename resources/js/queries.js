window.graphql = {
    api: '/web/api',
    categories: `{
          categories:shopCategories {
            id
            name
            code
            description
          }
        }`,
    createShop: `mutation createShop ($shop: NewShop!) {
          shop:createShop(shop: $shop) {
            id
            code
            name
          }
        }`,
    shopCategoriesAndBrands: `query shopCategoriesAndBrands($id: ID!, $count: Int!, $page: Int!) {
          shop(id: $id) {
            subCategoriesCount
            name
            categories(count: $count, page: $page) {
              data {
                id
                name
                productCount
                categories(count: $count, page: $page) {
                  data {
                    id
                    name
                  }
                }
              }
            }
            brands(count: $count, page: $page) {
              data {
                id
                name
                productCount
              }
            }
          }
        }`,
    shopProductCategories: `query productCategories($id: ID! $count: Int! $page: Int!){
          shop(id: $id) {
            categories(count: $count page: $page) {
                data {
                    id
                    name
                    productCount
                    categoryCount
                }
            }
          }
        }`,
    shopProductBrands: `query productBrands($id: ID! $count: Int! $page: Int!){
          shop(id: $id) {
            brands(count: $count page: $page) {
                data {
                    id
                    name
                    productCount
                }
            }
          }
        }`,
    createBrand: `mutation createBrand($shopId: ID! $brand: NewBrand!) {
          brand:createBrand(shopId: $shopId brand: $brand) {
            id
            name
            productCount
          }
        }`,
    createCategory: `mutation createCategory($shopId: ID! $category: NewProductCategory!) {
          category:createCategory(shopId: $shopId category: $category) {
            id
            name
            productCount
            categoryCount
          }
        }`,
    shopProductSubCategories: `query productSubCategories($id: ID! $count: Int! $page: Int!){
          shop(id: $id) {
                categories:subcategories(count: $count page: $page) {
                    data {
                        id
                        name
                        productCount
                        category {
                          name
                        }
                    }
                }
          }
        }`,
    createSubCategory: `mutation createSubCategory($categoryId: ID!, $subcategory: NewProductSubCategory!) {
          category:createSubCategory(categoryId: $categoryId, subcategory: $subcategory) {
            id
            name
            productCount
            category {
              name
            }
          }
        }`,
    shopProducts: `query shopProducts($shopId: ID!, $count: Int!, $page: Int!) {
          shop(id: $shopId) {
            products(count: $count, page: $page) {
              data {
                id
                name
                code
                active
                quantity
                price
                category {
                  name
                }
                subcategory {
                  name
                }
                brand {
                  name
                }
              }
            }
          }
        }`,
    shops: `query shops($count: Int! $page: Int!){
          shops(count: $count page: $page) {
            data {
              id
              code
              name
              productCount
              category {
                name
              }
            }
          }
        }`,
    myShops: `query myShops($count: Int!, $page: Int!) {
          me {
            shops(count: $count, page: $page) {
              data {
                id
                code
                name
                productCount
                category {
                  name
                }
              }
            }
          }
        }`,
    products: `query products($count: Int!, $page: Int!) {
          products(count: $count, page: $page) {
            data {
              id
              name
              code
              active
              quantity
              price
              category {
                name
              }
              subcategory {
                name
              }
              brand {
                name
              }
            }
          }
        }`,
    createProduct: `mutation createProduct($product: NewProduct!){
          createProduct(product: $product) {
            id
            code
            name
          }
        }`,
    productStock: `query productStock($id: ID! $type: String! $count: Int! $page: Int!){
          product(id: $id) {
            stock(type: $type count: $count page: $page) {
              data {
                quantity
                type
                note
                user {
                  name
                }
                created_at
              }
            }
          }
        }`,
    updateStock: `mutation updateStock($productId: ID!, $stock: NewStock!) {
          stock:updateStock(productId: $productId, stock: $stock) {
            quantity
            type
            note
            user {
              name
            }
            created_at
          }
        }`
};