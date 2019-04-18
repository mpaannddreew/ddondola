window.graphql = {
    api: '/web/api',
    rowCount: 10,
    columnCount: 12,
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
    shopCategoriesAndBrands: `query shopCategoriesAndBrands($id: ID! $count: Int! $page: Int!) {
          shop(id: $id) {
            subCategoriesCount
            name
            categories(count: $count page: $page) {
              data {
                id
                name
                productCount
                categories(count: $count page: $page) {
                  data {
                    id
                    name
                    productCount
                  }
                }
              }
            }
            brands(count: $count page: $page) {
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
                    description
                    productCount
                    categoryCount
                }
                paginatorInfo {
                    count
                    currentPage
                    firstItem
                    hasMorePages
                    lastItem
                    lastPage
                    perPage
                    total
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
                    description
                    productCount
                }
                paginatorInfo {
                    count
                    currentPage
                    firstItem
                    hasMorePages
                    lastItem
                    lastPage
                    perPage
                    total
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
                        description
                        productCount
                        category {
                          name
                        }
                    }
                    paginatorInfo {
                        count
                        currentPage
                        firstItem
                        hasMorePages
                        lastItem
                        lastPage
                        perPage
                        total
                    }
                }
          }
        }`,
    createSubCategory: `mutation createSubCategory($categoryId: ID! $subcategory: NewProductSubCategory!) {
          category:createSubCategory(categoryId: $categoryId subcategory: $subcategory) {
            id
            name
            productCount
            category {
              name
            }
          }
        }`,
    shopProducts: `query shopProducts($shopId: ID! $filters: ProductFilter $count: Int! $page: Int!) {
          shop(id: $shopId) {
            products(filters: $filters count: $count page: $page) {
              data {
                id
                name
                code
                active
                quantity
                price
                discount
                reviewCount
                averageRating
                discountedPrice
                currencyCode
                images {
                  url
                }
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
              paginatorInfo {
                count
                currentPage
                firstItem
                hasMorePages
                lastItem
                lastPage
                perPage
                total
              }
            }
          }
        }`,
    categoryProducts: `query categoryProducts($categoryId: ID! $filters: ProductFilter $count: Int! $page: Int!) {
          category:productCategory(id: $categoryId) {
            products(filters: $filters count: $count page: $page) {
              data {
                id
                name
                code
                active
                quantity
                price
                discount
                reviewCount
                averageRating
                discountedPrice
                currencyCode
                images {
                  url
                }
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
              paginatorInfo {
                count
                currentPage
                firstItem
                hasMorePages
                lastItem
                lastPage
                perPage
                total
              }
            }
          }
        }`,
    subcategoryProducts: `query subcategoryProducts($subcategoryId: ID! $filters: ProductFilter $count: Int! $page: Int!) {
          subcategory:productSubCategory(id: $subcategoryId) {
            products(filters: $filters count: $count page: $page) {
              data {
                id
                name
                code
                active
                quantity
                price
                discount
                reviewCount
                averageRating
                discountedPrice
                currencyCode
                images {
                  url
                }
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
              paginatorInfo {
                count
                currentPage
                firstItem
                hasMorePages
                lastItem
                lastPage
                perPage
                total
              }
            }
          }
        }`,
    shops: `query shops($categoryId: Int $count: Int! $page: Int!){
          shops(categoryId: $categoryId count: $count page: $page) {
            data {
              id
              code
              name
              productCount
              likes
              reviewCount
              currencyCode
              category {
                name
              }
              avatar{
                url
              }
              coverPicture {
                url
              }
            }
            paginatorInfo {
              count
              currentPage
              firstItem
              hasMorePages
              lastItem
              lastPage
              perPage
              total
            }
          }
        }`,
    myShops: `query myShops($categoryId: Int $count: Int! $page: Int!) {
          me {
            shops(categoryId: $categoryId count: $count page: $page) {
              data {
                id
                code
                name
                productCount
                likes
                reviewCount
                avatar{
                  url
                }
                coverPicture {
                  url
                }
                currencyCode
                category {
                  name
                }
              }
              paginatorInfo {
                count
                currentPage
                firstItem
                hasMorePages
                lastItem
                lastPage
                perPage
                total
              }
            }
          }
        }`,
    products: `query products($filters: ProductFilter $count: Int! $page: Int!) {
          products(filters: $filters count: $count page: $page) {
            data {
              id
              name
              code
              active
              quantity
              price
              discount
              reviewCount
              averageRating
              discountedPrice
              currencyCode
              images {
                url
              }
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
            paginatorInfo {
              count
              currentPage
              firstItem
              hasMorePages
              lastItem
              lastPage
              perPage
              total
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
    editProduct: `mutation editProduct($productId: ID! $product: EditProduct!){
          editProduct(productId: $productId product: $product) {
            id
            code
            name
          }
        }`,
    relatedProducts: `query relatedProducts($id: ID!) {
          product(id: $id) {
            products:relatedProducts {
              id
              name
              code
              active
              quantity
              price
              discount
              reviewCount
              averageRating
              discountedPrice
              currencyCode
              images {
                url
              }
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
              paginatorInfo {
                count
                currentPage
                firstItem
                hasMorePages
                lastItem
                lastPage
                perPage
                total
              }
            }
          }
        }`,
    updateStock: `mutation updateStock($productId: ID! $stock: NewStock!) {
          stock:updateStock(productId: $productId stock: $stock) {
            quantity
            type
            note
            user {
              name
            }
            created_at
          }
        }`,
    iLikeShop: `query iLikeShop($id: ID!) {
          like:iLikeShop(id: $id)
        }`,
    likeShop: `mutation likeShop($id: ID!) {
          like:likeShop(id: $id)
        }`,
    iFollowUser: `query iFollowUser($id: ID!) {
          follow:iFollowUser(id: $id)
        }`,
    followUser: `mutation followUser($id: ID!) {
          follow:followUser(id: $id)
        }`,
    inCart: `query inCart($id: ID!) {
          inCart(id: $id)
        }`,
    addToCart: `mutation addToCart($id: ID! $quantity: Int!) {
          inCart:addToCart(id: $id quantity: $quantity)
        }`,
    removeFromCart: `mutation removeFromCart($id: ID!) {
          inCart:removeFromCart(id: $id)
        }`,
    isFavorite: `query isFavorite($id: ID!) {
          isFavorite(id: $id)
        }`,
    addToFavorites: `mutation addToFavorites($id: ID!) {
          isFavorite:addToFavorites(id: $id)
        }`,
    removeFromFavorites: `mutation removeFromFavorites($id: ID!) {
          isFavorite:removeFromFavorites(id: $id)
        }`,
    users: `query users($count: Int! $page: Int!) {
          users(count: $count page: $page) {
            data {
              id
              code
              name
              avatar{
                url
              }
              coverPicture {
                url
              }
              followerCount
              followingCount
            }
            paginatorInfo {
                count
                currentPage
                firstItem
                hasMorePages
                lastItem
                lastPage
                perPage
                total
              }
          }
        }`,
    followers: `query followers($id: ID! $count: Int! $page: Int!){
          user(id: $id) {
            followers(count: $count page: $page) {
              data {
                id
                code
                name
                avatar{
                  url
                }
                coverPicture {
                  url
                }
                followerCount
                followingCount
              }
              paginatorInfo {
                count
                currentPage
                firstItem
                hasMorePages
                lastItem
                lastPage
                perPage
                total
              }
            }
          }
        }`,
    following: `query following($id: ID! $count: Int! $page: Int!){
          user(id: $id) {
            following(count: $count page: $page) {
              data {
                id
                code
                name
                avatar{
                  url
                }
                coverPicture {
                  url
                }
                followerCount
                followingCount
              }
              paginatorInfo {
                count
                currentPage
                firstItem
                hasMorePages
                lastItem
                lastPage
                perPage
                total
              }
            }
          }
        }`,
    myFollowers: `query myFollowers($count: Int! $page: Int!){
          me {
            followers(count: $count page: $page) {
              data {
                id
                code
                name
                avatar{
                  url
                }
                coverPicture {
                  url
                }
                followerCount
                followingCount
              }
              paginatorInfo {
                count
                currentPage
                firstItem
                hasMorePages
                lastItem
                lastPage
                perPage
                total
              }
            }
          }
        }`,
    myFollowing: `query myFollowing($count: Int! $page: Int!){
          me {
            following(count: $count page: $page) {
              data {
                id
                code
                name
                avatar{
                  url
                }
                coverPicture {
                  url
                }
                followerCount
                followingCount
              }
              paginatorInfo {
                count
                currentPage
                firstItem
                hasMorePages
                lastItem
                lastPage
                perPage
                total
              }
            }
          }
        }`,
    myFavoriteProducts: `query myFavoriteProducts($filters: ProductFilter $count: Int! $page: Int!){
          me {
            products:favouriteProducts(filters: $filters count: $count page: $page) {
                data {
                  id
                  name
                  code
                  active
                  quantity
                  price
                  discount
                  reviewCount
                  averageRating
                  discountedPrice
                  currencyCode
                  images {
                    url
                  }
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
                paginatorInfo {
                  count
                  currentPage
                  firstItem
                  hasMorePages
                  lastItem
                  lastPage
                  perPage
                  total
                }
            }
          }
        }`,
    searchProducts: `query searchProducts($name: String!) {
          results:searchProducts(name: $name) {
            id
            name
            price
            code
            discount
            reviewCount
            averageRating
            discountedPrice
            currencyCode
            images{
              url
            }
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
        }`,
    searchShops: `query searchShops($name: String!) {
          results:searchShops(name: $name) {
            id
            name
            code
            likes
            avatar{
              url
            }
            coverPicture {
              url
            }
            reviewCount
            category {
              name
            }
          }
        }`,
    searchUsers: `query searchUsers($name: String!) {
          results:searchUsers(name: $name) {
            id
            code
            name
            avatar{
              url
            }
            coverPicture {
              url
            }
            followerCount
            followingCount
          }
        }`,
    isReviewed: `query isReviewed($entity: Reviewable!) {
            isReviewed(entity: $entity) {
                isReviewed
                review {
                    id
                    rating
                    body
                }
            }
        }`,
    addReview: `mutation addReview($entity: Reviewable! $review: ReviewData!) {
            review:addReview(entity: $entity review: $review) {
                id
                rating
                body
                created_at
                reviewer {
                    name
                }
            }
        }`,
    editReview: `mutation editReview($id: ID! $review: ReviewData!) {
            review:editReview(id: $id review: $review) {
                id
                rating
                body
                created_at
                reviewer {
                    name
                }
            }
        }`,
    shopReviews: `query shopReviews($id: ID! $count: Int! $page: Int!){
          shop(id: $id) {
            reviews(count: $count page: $page) {
                data {
                    id
                    rating
                    body
                    created_at
                    reviewer {
                        name
                        avatar{
                          url
                        }
                        coverPicture {
                          url
                        }
                        code
                    }
                }
                paginatorInfo {
                    count
                    currentPage
                    firstItem
                    hasMorePages
                    lastItem
                    lastPage
                    perPage
                    total
                }
            }
          }
        }`,
    productReviews: `query productReviews($id: ID! $count: Int! $page: Int!){
          product(id: $id) {
            reviews(count: $count page: $page) {
                data {
                    id
                    rating
                    body
                    created_at
                    reviewer {
                        name
                        avatar{
                          url
                        }
                        coverPicture {
                          url
                        }
                        code
                    }
                }
                paginatorInfo {
                    count
                    currentPage
                    firstItem
                    hasMorePages
                    lastItem
                    lastPage
                    perPage
                    total
                }
            }
          }
        }`,
    myCart: `query myCart {
        me {
            cart {
              id
              sum
              productCount
            }
        }
    }`,
    myCartProducts: `query myCartProducts {
        me {
          cart {
              sum
              products {
                id
                quantity
                price
                name
                code
                discountedPrice
                currencyCode
                images {
                  url
                }
                pivot:cartPivot {
                  id
                  sum
                  price
                  quantity
                }
              }
           }
        }
    }`,
    productsOffers: `query productsOffers($id: ID! $ordering: String $count: Int! $page: Int!) {
          product(id: $id) {
            offers(ordering: $ordering count: $count page: $page) {
              data {
                id
                discount
                start_date
                end_date
                cancelled
                active
              }
              paginatorInfo {
                count
                currentPage
                firstItem
                hasMorePages
                lastItem
                lastPage
                perPage
                total
              }
            }
          }
        }`,
    createProductOffer: `mutation createProductOffer($productId: ID! $offer: NewOffer!) {
            offer:createProductOffer(productId: $productId offer: $offer) {
                id
                discount
                start_date
                end_date
                cancel
            }
        }`,
    activeShopOffers: `query activeShopOffers($shopId: ID! $ordering: String! $count: Int! $page: Int!) {
          shop(id: $shopId) {
            deals: activeOffers {
              id
              name
              code
              active
              quantity
              price
              discount
              reviewCount
              averageRating
              discountedPrice
              currencyCode
              images {
                url
              }
              category {
                name
              }
              subcategory {
                name
              }
              brand {
                name
              }
              offers(ordering: $ordering, count: $count, page: $page) {
                data {
                  discount
                  start_date
                  end_date
                  cancelled
                  active
                }
              }
            }
          }
        }`,
    myTimeline: `query myTimeline($ordering: String, $count: Int!, $page: Int!) {
          me {
            timeline(ordering: $ordering, count: $count, page: $page) {
              data {
                id
                verb
                action
                actor {
                  id
                  name
                  type
                  code
                  avatar{
                    url
                  }
                  coverPicture {
                    url
                  }
                }
                subject {
                  type
                  product {
                    id
                    name
                    code
                    description
                    price
                    discountedPrice
                    currencyCode
                    images {
                      url
                    }
                    brand {
                      name
                    }
                    category {
                      name
                    }
                    subcategory {
                      name
                    }
                  }
                  user {
                    id
                    name
                    code
                    avatar {
                      url
                    }
                  }
                  shop {
                    id
                    name
                    code
                    avatar {
                      url
                    }
                    category {
                      name
                    }
                    profile {
                      description
                    }
                  }
                }
                foreign {
                  review {
                    rating
                    body
                  }
                  offer {
                    discount
                    start_date
                    end_date
                    cancelled
                    active
                    started
                    ended
                  }
                }
                created_at
              }
              paginatorInfo {
                count
                currentPage
                firstItem
                hasMorePages
                lastItem
                lastPage
                perPage
                total
              }
            }
          }
        }`,
    myNews: `query myNews($ordering: String, $count: Int!, $page: Int!) {
          me {
            news(ordering: $ordering, count: $count, page: $page) {
              data {
                id
                verb
                action
                actor {
                  id
                  name
                  type
                  code
                  avatar{
                    url
                  }
                  coverPicture {
                    url
                  }
                }
                subject {
                  type
                  product {
                    id
                    name
                    code
                    description
                    price
                    discountedPrice
                    currencyCode
                    images {
                      url
                    }
                    brand {
                      name
                    }
                    category {
                      name
                    }
                    subcategory {
                      name
                    }
                  }
                  user {
                    id
                    name
                    code
                    avatar {
                      url
                    }
                  }
                  shop {
                    id
                    name
                    code
                    avatar {
                      url
                    }
                    category {
                      name
                    }
                    profile {
                      description
                    }
                  }
                }
                foreign {
                  review {
                    rating
                    body
                  }
                  offer {
                    discount
                    start_date
                    end_date
                    cancelled
                    active
                    started
                    ended
                  }
                }
                created_at
              }
              paginatorInfo {
                count
                currentPage
                firstItem
                hasMorePages
                lastItem
                lastPage
                perPage
                total
              }
            }
          }
        }`,
    userTimeline: `query userTimeline($id: ID! $ordering: String, $count: Int!, $page: Int!) {
          user(id: $id) {
            timeline(ordering: $ordering, count: $count, page: $page) {
              data {
                id
                verb
                action
                actor {
                  id
                  name
                  type
                  code
                  avatar{
                    url
                  }
                  coverPicture {
                    url
                  }
                }
                subject {
                  type
                  product {
                    id
                    name
                    code
                    description
                    price
                    discountedPrice
                    currencyCode
                    images {
                      url
                    }
                    brand {
                      name
                    }
                    category {
                      name
                    }
                    subcategory {
                      name
                    }
                  }
                  user {
                    id
                    name
                    code
                    avatar {
                      url
                    }
                  }
                  shop {
                    id
                    name
                    code
                    avatar {
                      url
                    }
                    category {
                      name
                    }
                    profile {
                      description
                    }
                  }
                }
                foreign {
                  review {
                    rating
                    body
                  }
                  offer {
                    discount
                    start_date
                    end_date
                    cancelled
                    active
                    started
                    ended
                  }
                }
                created_at
              }
              paginatorInfo {
                count
                currentPage
                firstItem
                hasMorePages
                lastItem
                lastPage
                perPage
                total
              }
            }
          }
        }`,
    shopTimeline: `query shopTimeline($id: ID! $ordering: String, $count: Int!, $page: Int!) {
          shop(id: $id) {
            timeline(ordering: $ordering, count: $count, page: $page) {
              data {
                id
                verb
                action
                actor {
                  id
                  name
                  type
                  code
                  avatar{
                    url
                  }
                  coverPicture {
                    url
                  }
                }
                subject {
                  type
                  product {
                    id
                    name
                    code
                    description
                    price
                    discountedPrice
                    currencyCode
                    images {
                      url
                    }
                    brand {
                      name
                    }
                    category {
                      name
                    }
                    subcategory {
                      name
                    }
                  }
                  user {
                    id
                    name
                    code
                    avatar {
                      url
                    }
                  }
                  shop {
                    id
                    name
                    code
                    avatar {
                      url
                    }
                    category {
                      name
                    }
                    profile {
                      description
                    }
                  }
                }
                foreign {
                  review {
                    rating
                    body
                  }
                  offer {
                    discount
                    start_date
                    end_date
                    cancelled
                    active
                    started
                    ended
                  }
                }
                created_at
              }
              paginatorInfo {
                count
                currentPage
                firstItem
                hasMorePages
                lastItem
                lastPage
                perPage
                total
              }
            }
          }
        }`,
    myNotifications: `query myNotifications($count: Int!, $page: Int!) {
          me {
            notifications(count: $count, page: $page) {
              data {
                id
                notifiable {
                  id
                  name
                  type
                  code
                  avatar {
                    url
                  }
                }
                read_at
                created_at
                data
              }
              paginatorInfo {
                count
                currentPage
                firstItem
                hasMorePages
                lastItem
                lastPage
                perPage
                total
              }
            }
          }
        }`
};