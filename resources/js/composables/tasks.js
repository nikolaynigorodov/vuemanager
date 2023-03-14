import { ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";
export default function useTasks() {
    const tasks = ref([])
    const task = ref([])
    const router = useRouter();

    const errors = ref('');
    /*let user = document.getElementById('user-id').getAttribute('data-user-id');*/

    const getTasks = async () => {
        let responce = await axios.get('/task')
        tasks.value = responce.data.data;
    }

    const getTask = async (id) => {
        try {
            let responce = await axios.get('/task/' + id)
            task.value = responce.data.data;
        } catch (e) {
            await router.push({ name: 'tasks.index' });
        }

    }

    const storeTask = async (data) => {
        errors.value = '';

        try {
            await axios.post('/task', data);
            await router.push({ name: 'tasks.index' });
        } catch (e) {
            if(e.response.status === 422) {
                for(const key in e.response.data.errors) {
                    errors.value += e.response.data.errors[key][0] + ' ';
                }
            }
        }
    }

    const updateTask = async (id) => {
        errors.value = '';

        try {
            await axios.put('/task/' + id, task.value);
            await router.push({ name: 'tasks.index' });
        } catch (e) {
            if(e.response.status === 422) {
                for(const key in e.response.data.errors) {
                    errors.value += e.response.data.errors[key][0] + ' ';
                }
            }
        }
    }

    const destroyTask = async (id) => {
        await axios.delete('/task/' + id)
    }

    return {
        tasks,
        task,
        errors,
        getTasks,
        getTask,
        storeTask,
        updateTask,
        destroyTask
    }
}
