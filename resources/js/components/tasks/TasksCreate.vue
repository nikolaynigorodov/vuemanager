<template>
    <h3 style="text-align: center">Create Tasks</h3>

    <div class="mt-2 mb-6 text-sm text-danger" v-if="errors !== ''">
        {{ errors }}
    </div>
    <form @submit.prevent="saveTask">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" v-model="form.title">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" rows="3" name="description" v-model="form.description"></textarea>
        </div>
        <div class="form-group">
            <label for="end_date">Date Finish</label>
            <div class="col-sm-2">
                <input type="date" class="form-control" name="end_date" v-model="form.end_date">
            </div>

        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <div class="col-sm-2">
                <select class="form-control" id="status" name="status" v-model="form.status">
                    <option value="1">Waiting</option>
                    <option value="2">In progress</option>
                    <option value="3">Completed</option>
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-success mt-3">Create</button>
    </form>

</template>

<script>
import { reactive } from "vue";
import useTasks from "../../composables/tasks";
export default {
    setup() {
        const form = reactive({
            'title': '',
            'description': '',
            'end_date': '',
            'status': '',
        })

        const { errors, storeTask } = useTasks();

        const saveTask = async () => {
            await storeTask({...form});
        }

        return {
            form,
            errors,
            saveTask
        }
    }
}
</script>
