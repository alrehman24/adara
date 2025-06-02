export function getUrlList()
{
     const baseUrl = 'http://localhost:8000/api/';
     return {
          getHeaderCategoriesData: baseUrl + 'getHeaderCategoriesData',
          getHomeData: baseUrl + 'getHomeData',
          getCategoryData: baseUrl + 'getCategoryData',

     }
}
export default getUrlList;
