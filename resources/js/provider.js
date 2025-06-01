export function getUrlList()
{
     const baseUrl = 'http://localhost:8000/api/';
     return {
          getHeaderCategoriesData: baseUrl + 'getHeaderCategoriesData',
          getHomeData: baseUrl + 'getHomeData',

     }
}
export default getUrlList;
