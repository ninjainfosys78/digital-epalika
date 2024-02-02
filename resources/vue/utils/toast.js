import {useToast} from 'vue-toastification'
import "vue-toastification/dist/index.css";

export const toast = (status, title) => {
    const errors = [400, 401, 403, 404, 405, 408, 414, 415, 422, 429, 500]
    if (status === 200 || status === 201) {
        useToast().success(title)
    } else if (errors.includes(status)) {
        useToast().error(title)
    }
}
