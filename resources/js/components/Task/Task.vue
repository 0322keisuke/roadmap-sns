<template>
    <div class="row mt-2">
        <div class="col col-md-3.8 border m-2 bg-color">
            <h3 class="text-center">Todo</h3>
            <p>やることタスクの数：{{ Todo.length }}</p>
            <draggable group="tasks" v-model="Todo">
                <div
                    v-for="task in Todo"
                    :key="task.id"
                    class="d-flex flex-row list border p-2 m-2"
                >
                    {{ task.name }}
                    <div class="deletelist" @click="removeTask(task)">×</div>
                </div>
            </draggable>
            <div class="m-1">
                <task-add :status="1" />
            </div>
        </div>
        <div class="col col-md-3.8 border m-2 bg bg-color">
            <h3 class="text-center">Doing</h3>
            <p>実施中タスクの数：{{ Doing.length }}</p>
            <draggable group="tasks" v-model="Doing">
                <div
                    v-for="task in Doing"
                    :key="task.id"
                    class="d-flex flex-row list border p-2 m-2"
                >
                    {{ task.name }}
                    <div class="deletelist" @click="removeTask(task)">×</div>
                </div>
            </draggable>
            <div class="m-1">
                <task-add :status="2" />
            </div>
        </div>
        <div class="col col-md-3.8 border m-2 bg bg-color">
            <h3 class="text-center">Done</h3>
            <p>完了タスクの数：{{ Done.length }}</p>
            <draggable group="tasks" v-model="Done">
                <div
                    v-for="task in Done"
                    :key="task.id"
                    class="d-flex flex-row list border p-2 m-2"
                >
                    {{ task.name }}
                    <div class="deletelist" @click="removeTask(task)">×</div>
                </div>
            </draggable>
            <div class="m-1">
                <task-add :status="3" />
            </div>
        </div>
    </div>
</template>

<script>
import draggable from "vuedraggable";
import TaskAdd from "./TaskAdd";
import { mapState } from "vuex";

export default {
    components: {
        draggable,
        TaskAdd
    },
    props: {
        initialTasks: {
            type: Array,
            default: []
        }
    },
    data() {
        return {
            getTasks: this.initialTasks
        };
    },
    mounted: function() {
        this.$store.dispatch("task/initialtask", this.getTasks);
    },
    computed: {
        ...mapState({
            tasks: state => state.task.tasks,
            display_tutorial_id: state => state.tutorial.display_tutorial_id
        }),
        DisplayTasks: function() {
            return this.tasks.filter(task => {
                return task.tutorial_id === this.display_tutorial_id;
            });
        },
        Todo: {
            get() {
                return this.$store.getters["task/Todo"];
            },
            set(value) {
                this.$store.commit("task/setTask", value);
            }
        },
        Doing: {
            get() {
                return this.$store.getters["task/Doing"];
            },
            set(value) {
                this.$store.commit("task/setTask", value);
            }
        },
        Done: {
            get() {
                return this.$store.getters["task/Done"];
            },
            set(value) {
                this.$store.commit("task/setTask", value);
            }
        }
        // Todo: function() {
        //     return this.DisplayTasks.filter(function(task) {
        //         return task.status === 1;
        //     });
        // }
        // Doing: function() {
        //     return this.DisplayTasks.filter(function(task) {
        //         return task.status === 2;
        //     });
        // },
        // Done: function() {
        //     return this.DisplayTasks.filter(function(task) {
        //         return task.status === 3;
        //     });
        // }
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
