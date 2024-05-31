import React from "react"
import { useTasks } from "../../queris/TaskQuery"
import TaskInput from "./components/TaskInput"
import TaskList from "./components/TaskList"



const TaskPage = () => {
    return(
        <>
            <TaskInput />
            <TaskList />
            </>
    )
}

export default TaskPage