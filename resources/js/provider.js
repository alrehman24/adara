export function getUrlList()
{
     const baseUrl = 'http://localhost:8000/api/';
     return {
          getHeaderCategoriesData: baseUrl + 'getHeaderCategoriesData',
     }
}
export default getUrlList;
