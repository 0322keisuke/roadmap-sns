<template>
    <div class="col col-md-3.8 border m-2 bg-color">
        <h3 class="text-center">{{ title }}</h3>
        <p>{{ displayTasks.length }}枚のタスク</p>
        <draggable
            group="tasks"
            :list="displayTasks"
            @update="
                $emit('updateStatus', status);
                $emit('update', $event);
            "
            @add="$emit('addStatus', status)"
            @remove="
                $emit('removeStatus', status);
                $emit('remove', $event);
            "
            ;
        >
            <div
                v-for="task in displayTasks"
                :key="task.id"
                class="d-flex flex-row list border p-2 m-2"
            >
                {{ task.name }}
                <div class="deletelist" @click="removeTask(task)">×</div>
            </div>
        </draggable>
        <div class="m-1">
            <task-add :status="status" />
        </div>
    </div>
</template>

<script>
import draggable from "vuedraggable";
import TaskAdd from "./TaskAdd";

export default {
    components: {
        draggable,
        TaskAdd
    },
    props: {
        title: {
            type: String
        },
        status: {
            type: Number
        },
        displayTasks: {
            type: Array,
            default: []
        }
    },
    methods: {
        removeTask: function(task) {
            if (confirm("本当にこのタスクを削除しますか？")) {
                this.$store.dispatch("task/removeTask", {
                    id: task.id
                });
            }
        }
    }
};
</script>
