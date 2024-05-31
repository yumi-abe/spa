import { Task } from "../types/task"
import axios from "axios"

const getTasks = async () => {
    const { data } = await axios.get<Task[]>('api/tasks')
    return data
}

export {
    getTasks
}