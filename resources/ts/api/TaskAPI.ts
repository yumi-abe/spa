import { Task } from "../types/task"
import axios from "axios"

const getTasks = async () => {
    const { data } = await axios.get<Task[]>('api/tasks')
    return data
}

const updateDoneTask = async ({ id, is_done }: Task) => {
    const { data } = await axios.patch<Task[]>(
        `api/tasks/update-done/${id}`,
        { is_done: !is_done }
    )
    return data
}

export {
    getTasks,
    updateDoneTask
}