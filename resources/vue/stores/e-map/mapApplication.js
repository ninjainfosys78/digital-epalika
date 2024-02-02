import {defineStore} from 'pinia'
import axios from "axios";
const baseUrl=`${window.location.origin}`

export const useMapApplicationStore = defineStore('map-application', {
    actions: {
        storeMapApplication(form) {
            return axios.post(`${baseUrl}/ebps/api/v1/map-application`,form)
                .then((res) => {
                    return res;
                })
                .catch((err) => {
                    throw err;
                })
        }
    }
})
