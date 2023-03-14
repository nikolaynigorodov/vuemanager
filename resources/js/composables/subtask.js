import { ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";
export default function useSubtasks() {
    const subtask = ref([])
    const router = useRouter();

    const errors = ref('');

    const getSubtask = async (id) => {
        try {
            let responce = await axios.get('/subtask/' + id)
            subtask.value = responce.data.data;
        } catch (e) {
            await router.push({ name: 'tasks.index' });
        }

    }

    const storeSubtask = async (data, task_id) => {
        errors.value = '';

        try {
            data['task_id'] = task_id;
            await axios.post('/subtask', data);
            await router.push({ name: 'tasks.index' });
        } catch (e) {
            if(e.response.status === 422) {
                for(const key in e.response.data.errors) {
                    errors.value += e.response.data.errors[key][0] + ' ';
                }
            }
        }
    }

    const updateSubtask = async (subtask_id) => {
        errors.value = '';

        try {
            await axios.put('/subtask/' + subtask_id, subtask.value);
            await router.push({ name: 'tasks.index' });
        } catch (e) {
            if(e.response.status === 422) {
                for(const key in e.response.data.errors) {
                    errors.value += e.response.data.errors[key][0] + ' ';
                }
            }
        }
    }

    const destroySubtask = async (id) => {
        await axios.delete('/subtask/' + id)
    }

    return {
        subtask,
        errors,
        getSubtask,
        storeSubtask,
        updateSubtask,
        destroySubtask
    }
}
