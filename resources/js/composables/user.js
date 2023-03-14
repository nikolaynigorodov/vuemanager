import { ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";
export default function useUser() {
    const user = ref([]);
    const getUser = async () => {
        let responce = await axios.get('/user')
        user.value = responce.data.data;
    }

    return {
        user,
        getUser,
    }
}
