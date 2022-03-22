// import axios from "axios";
// export default axios.create({
//   baseURL: "http://localhost",
//   headers: {
//     "Content-type": "application/json"
//   }
// });

import axios from 'axios'
let instance = axios.create({
    baseURL: 'http://localhost',
    // withCredentials: true
})

instance.interceptors.request.use( request => {
    request.headers.common['Accept'] = 'application/json'
    // request.headers.common['Accept'] = 'multipart/form-data'
    // request.headers.common['Access-Control-Allow-Origin'] = '*';
    // request.headers.common['content-type'] = 'application/json' 
    // request.headers.common['Content-Type'] = 'multipart/form-data'
    return request
})

export default instance
    

