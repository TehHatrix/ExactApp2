import api from "./config"

export default {
    async index(){
        return api.get("api/item/index");
    },

    async createItem(payload){
        return api.post("api/item/create",payload);
    },

    async deleteItem(code){
        return api.delete(`api/item/delete/${code}`);
    },

    
    async updateItem(payload){
        return api.put("api/item/update",payload);
    },
}