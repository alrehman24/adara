export function getUrlList()
{
     const baseUrl = 'http://localhost:8000/api/';
     return {
          getHeaderCategoriesData: baseUrl + 'getHeaderCategoriesData',
          getHomeData: baseUrl + 'getHomeData',
          getCategoryData: baseUrl + 'getCategoryData',
          getUserData: baseUrl + 'getUserData',
          getCartData: baseUrl + 'getCartData',
          addToCart: baseUrl + 'addToCart',
          getProductData: baseUrl + 'getProductData',
          removeCartItem: baseUrl + 'removeCartItem',


     }
}
export default getUrlList;
