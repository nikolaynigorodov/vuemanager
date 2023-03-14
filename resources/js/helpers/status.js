import {ref} from "vue";

export default function getStatus() {
    const statusName = {
        1 : {'name': 'Waiting', 'color': 'text-warning'},
        2 : {'name': 'In Progress', 'color': 'text-primary'},
        3 : {'name': 'Completed', 'color': 'text-success'}
    };

    return {
        statusName
    }
}
