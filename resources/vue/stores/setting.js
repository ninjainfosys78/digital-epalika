import {defineStore} from 'pinia'
import axios from "axios";
import showErrors from "../utils/showErrors";
const baseUrl=`${window.location.origin}`

export const useSettingStore = defineStore('setting', {
    state: () => ({
        eMapSetting: {}
    }),
    actions: {
        getEMapSetting() {
            return axios.get(`${baseUrl}/ebps/api/v1/mapApplySetting`)
                .then((res) => {
                    this.eMapSetting = res.data;
                })
                .catch((err) => {
                    showErrors(err);
                })
        }
    }
})
