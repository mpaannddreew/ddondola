window.graphql = {
    api: '/web/api',
    rowCount: 10,
    columnCount: 12,
    categories: `query categories($count: Int! $page: Int!){
          categories:shopCategories(count: $count page: $page) {
            data {
                id
                name
                code
                description
                shopCount
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
    createShop: `mutation createShop ($shop: NewShop!) {
          shop:createShop(shop: $shop) {
            id
            code
            name
          }
        }`,
    shopByCode: `query shop($shop: String!){
          shop:shopByCode(shop: $shop) {
            id
            code
            name
            productCount
            likes
            reviewCount
            averageRating
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
            profile {
              email
            }
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
                categories {
                  id
                  name
                  productCount
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
    shopCategoriesAndSubCategories: `query shopCategoriesAndSubCategories($shop: String! $count: Int! $page: Int!) {
          shop:shopByCode(shop: $shop) {
            subCategoriesCount
            name
            categories(count: $count page: $page) {
              data {
                id
                code
                name
                productCount
                categories {
                  id
                  name
                  productCount
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
    shopProductCategories: `query productCategories($shop: String! $count: Int! $page: Int!){
          shop:shopByCode(shop: $shop) {
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
    shopProductBrands: `query productBrands($shop: String! $count: Int! $page: Int!){
          shop:shopByCode(shop: $shop) {
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
    createBrand: `mutation createBrand($shop: String! $brand: ShopResource!) {
          brand:createBrand(shop: $shop brand: $brand) {
            id
            name
            productCount
          }
        }`,
    createCategory: `mutation createCategory($shop: String! $category: ShopResource!) {
          category:createCategory(shop: $shop category: $category) {
            id
            name
            productCount
            categoryCount
          }
        }`,
    createShopCategory: `mutation createShopCategory($category: ShopResource!) {
          category:createCategory(category: $category) {
            id
            name
            shopCount
            description
          }
        }`,
    shopProductSubCategories: `query productSubCategories($shop: String! $count: Int! $page: Int!){
          shop:shopByCode(shop: $shop) {
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
    createSubCategory: `mutation createSubCategory($categoryId: ID! $subcategory: ShopResource!) {
          category:createSubCategory(categoryId: $categoryId subcategory: $subcategory) {
            id
            name
            productCount
            category {
              name
            }
          }
        }`,
    shopProducts: `query shopProducts($shop: String! $filters: ProductFilter $count: Int! $page: Int!) {
          shop:shopByCode(shop: $shop) {
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
    shops: `query shops($filters: ShopFilter $count: Int! $page: Int!){
          shops(filters: $filters count: $count page: $page) {
            data {
              id
              code
              name
              productCount
              likes
              reviewCount
              averageRating
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
    myShops: `query myShops($count: Int! $page: Int!) {
          me {
            shops(count: $count page: $page) {
              data {
                id
                code
                name
                productCount
                likes
                reviewCount
                averageRating
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
    userShops: `query userShops($user: String! $count: Int! $page: Int!) {
          user:userByCode(user: $user) {
            shops(count: $count page: $page) {
              data {
                id
                code
                name
                productCount
                likes
                reviewCount
                averageRating
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
    products: `query products($category: String $filters: ProductFilter $count: Int! $page: Int!) {
          products(category: $category filters: $filters count: $count page: $page) {
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
    featuredProducts: `query featuredProducts {
          products: featuredProducts {
            name
            code
            reviewCount
            averageRating
            images {
              url
            }
          }
        }`,
    featuredShops: `query featuredShops {
          shops:featuredShops {
            code
            name
            reviewCount
            averageRating
            avatar {
              url
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
    userByCode: `query user($user: String!) {
          user:userByCode(user: $user) {
            id
            code
            name
            email
            avatar{
                url
            }
            coverPicture {
                url
            }
            followerCount
            followingCount
            profile {
                phone_number
                description
                address
            }
          }
        }`,
    users: `query users($count: Int! $page: Int!) {
          users(count: $count page: $page) {
            data {
              id
              code
              name
              email
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
          products:searchProducts(name: $name) {
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
          shops:searchShops(name: $name) {
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
          users:searchUsers(name: $name) {
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
    isReviewed: `query isReviewed($entity: Reviewee!) {
            isReviewed(entity: $entity) {
                isReviewed
                review {
                    id
                    rating
                    body
                }
            }
        }`,
    addReview: `mutation addReview($entity: Reviewee! $review: ReviewData!) {
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
                cancelled
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
              offers(ordering: $ordering count: $count page: $page) {
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
    myActivity: `query myActivity($count: Int! $page: Int!){
          me{
            activity(count: $count page: $page) {
              data {
                id
                body
                rating
                created_at
                reviewer {
                  id
                  name
                  code
                  avatar {
                    url
                  }
                }
                reviewable {
                  id
                  type
                  shop {
                    id
                    name
                    code
                    profile {
                      description
                    }
                    category {
                      name
                    }
                    avatar {
                      url
                    }
                    coverPicture {
                      url
                    }
                  }
                  product {
                    id
                    name
                    code
                    price
                    description
                    discountedPrice
                    discount
                    currencyCode
                    created_at
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
                    shop {
                      name
                      code
                      avatar {
                        url
                      }
                    }
                  }
                }
              }
            }
          }
        }`,
    userActivity: `query userActivity($id: ID! $count: Int! $page: Int!){
          user(id: $id){
            activity(count: $count page: $page) {
              data {
                id
                body
                rating
                created_at
                reviewer {
                  id
                  name
                  code
                  avatar {
                    url
                  }
                }
                reviewable {
                  id
                  type
                  shop {
                    id
                    name
                    code
                    profile {
                      description
                    }
                    category {
                      name
                    }
                    avatar {
                      url
                    }
                    coverPicture {
                      url
                    }
                  }
                  product {
                    id
                    name
                    code
                    price
                    description
                    discountedPrice
                    discount
                    currencyCode
                    created_at
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
                    shop {
                      name
                      code
                      avatar {
                        url
                      }
                    }
                  }
                }
              }
            }
          }
        }`,
    myNotifications: `query myNotifications($count: Int! $page: Int!) {
          me {
            notifications(count: $count page: $page) {
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
        }`,
    myConversations: `query myConversations($count: Int! $page: Int!) {
          me {
            conversations(count: $count page: $page) {
              data {
                id
                initiator {
                  id
                  name
                  type
                  code
                  avatar {
                    url
                  }
                }
                participant {
                  id
                  name
                  type
                  code
                  avatar {
                    url
                  }
                }
                latestMessage {
                  message
                  created_at
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
    shopConversations: `query shopConversations($id: ID! $count: Int! $page: Int!) {
          shop(id: $id) {
            conversations(count: $count page: $page) {
              data {
                id
                initiator {
                  id
                  name
                  type
                  code
                  avatar {
                    url
                  }
                }
                participant {
                  id
                  name
                  type
                  code
                  avatar {
                    url
                  }
                }
                latestMessage {
                  message
                  created_at
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
    shopContacts: `query shopContacts($id: ID! $count: Int! $page: Int!){
          shop(id: $id) {
            contacts(count: $count page: $page) {
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
    myContacts: `query myContacts($count: Int! $page: Int!){
          me {
            contacts(count: $count page: $page) {
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
    conversation: `query conversation($initiator: String $participant: String!) {
          conversation(initiator: $initiator participant: $participant) {
            id
            initiator {
              id
              name
              type
              code
              avatar {
                url
              }
            }
            participant {
              id
              name
              type
              code
              avatar {
                url
              }
            }
          }
        }`,
    conversationMessages: `query conversationMessages($initiator: String $participant: String! $count: Int! $page: Int!) {
          conversation(initiator: $initiator participant: $participant) {
            messages(count: $count page: $page) {
              data {
                id
                message
                sender {
                  id
                  name
                  type
                  code
                  avatar {
                    url
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
    startConversation: `mutation startConversation($initiator: String $participant: String!) {
          conversation:startConversation(initiator: $initiator participant: $participant) {
            id
            initiator {
              id
              name
              type
              code
              avatar {
                url
              }
            }
            participant {
              id
              name
              type
              code
              avatar {
                url
              }
            }
          }
        }`,
    myOrders: `query myOrders($page: Int! $count: Int!) {
          me {
            orders(page: $page count: $count) {
              data {
                id
                code
                sum
                productCount
                currencyCode
                created_at
                firstProduct {
                  images {
                    url
                  }
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
    shopOrders: `query myOrders($shop: String! $page: Int! $count: Int!) {
          shop:shopByCode(shop: $shop) {
            orders(page: $page count: $count) {
              data {
                id
                code
                sum
                productCount
                currencyCode
                created_at
                by {
                  code
                  name
                  email
                  avatar {
                    url
                  }
                }
                firstProduct {
                  images {
                    url
                  }
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
    orderProducts: `query orderProducts($order: String! $shop: String $page: Int! $count: Int!) {
          order(order: $order) {
            sum
            currencyCode
            by {
              code
              name
              email
              avatar {
                url
              }
            }
            created_at
            products(shop: $shop page: $page count: $count) {
              data {
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
                pivot: orderPivot {
                  id
                  sum
                  price
                  quantity
                  receipt_confirmed
                  delivery_confirmed
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
    editCategory: `mutation editCategory($categoryId: ID! $category: ShopResource!) {
          editCategory(categoryId: $categoryId category: $category) {
            id
            name
            description
          }
        }`,
    editShopCategory: `mutation editShopCategory($categoryId: ID! $category: ShopResource!) {
          editShopCategory(categoryId: $categoryId category: $category) {
            id
            name
            description
          }
        }`,
    editSubCategory: `mutation editSubCategory($categoryId: ID! $subcategory: ShopResource!) {
          editSubCategory(categoryId: $categoryId subcategory: $subcategory) {
            id
            name
            description
          }
        }`,
    editBrand: `mutation editBrand($brandId: ID! $brand: ShopResource!) {
          editBrand(brandId: $brandId brand: $brand) {
            id
            name
            description
          }
        }`,
    sendMessage: `mutation sendMessage($initiator: String $participant: String! $message: String) {
          sendMessage(initiator: $initiator participant: $participant message: $message) {
            id
            message
            sender {
              id
              name
              type
              code
              avatar {
                url
              }
            }
            created_at
          }
        }`,
    myProductFeed: `query myProductFeed($count: Int! $page: Int!){
          me {
            products:recommendedProducts(count: $count page: $page) {
                data {
                  id
                  name
                  code
                  description
                  quantity
                  price
                  discount
                  reviewCount
                  averageRating
                  discountedPrice
                  currencyCode
                  created_at
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
                  shop {
                    name
                    code
                    avatar {
                      url
                    }
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
        }`
};