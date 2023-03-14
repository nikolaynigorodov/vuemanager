<template>
    <h3 style="text-align: center">Edit Subtask</h3>

    <div class="mt-2 mb-6 text-sm text-danger" v-if="errors !== ''">
        {{ errors }}
    </div>

    <form @submit.prevent="saveSubtask">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" v-model="subtask.title">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" rows="3" name="description" v-model="subtask.description"></textarea>
        </div>
        <div class="form-group">
            <label for="end_date">Date Finish</label>
            <div class="col-sm-2">
                <input type="date" class="form-control" name="end_date" v-model="subtask.end_date">
            </div>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <div class="col-sm-2">
                <select class="form-control" id="status" name="status" v-model="subtask.status">
                    <option value="1">Waiting</option>
                    <option value="2">In progress</option>
                    <option value="3">Completed</option>
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-success mt-3">Update</button>
    </form>
</template>

<script>
import {onMounted} from "vue";
import useSubtasks from "../../composables/subtask";

export default {
    props: {
        subtask_id: {
            required: true,
            type: String
        }
    },
    setup(props) {

        const { errors, subtask, getSubtask, updateSubtask } = useSubtasks()

        onMounted(() => {
            getSubtask(props.subtask_id)
        })

        const saveSubtask = async () => {
            await updateSubtask(props.subtask_id)
        }

        return {
            subtask,
            errors,
            getSubtask,
            saveSubtask
        }
    }
}
</script>
