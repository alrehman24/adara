export function getUrlList()
{
     const baseUrl = 'http://localhost:8000/api/';
     return {
          getHeaderCategoriesData: baseUrl + 'getHeaderCategoriesData',
          getHomeData: baseUrl + 'getHomeData',
          getCategoryData: baseUrl + 'getCategoryData',
          getUserData: baseUrl + 'getUserData',

     }
}
export default getUrlList;
