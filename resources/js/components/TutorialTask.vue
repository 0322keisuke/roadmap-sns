<template>
    <div>
        <tutorial />

        <div class="d-flex align-items-center mt-2" v-if="initialTutorialId">
            <div class="mr-2">教材の学習状況:</div>
            <div class="dropdown">
                <button
                    class="btn btn-info dropdown-toggle"
                    type="button"
                    id="dropdownMenu"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                >
                    {{ status[tutorials[display_tutorial_listIndex].status] }}
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenu">
                    <button
                        class="dropdown-item"
                        type="button"
                        @click="updateTutorialStatus(1)"
                    >
                        計画中
                    </button>
                    <button
                        class="dropdown-item"
                        type="button"
                        @click="updateTutorialStatus(2)"
                    >
                        学習中
                    </button>
                    <button
                        class="dropdown-item"
                        type="button"
                        @click="updateTutorialStatus(3)"
                    >
                        完了
                    </button>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <task
                v-for="task in DisplayTasks"
                :key="task.id"
                :title="task.title"
                :status="task.status"
                :displayTasks="task.tasks"
                @updateStatus="updateStatus = $event"
                @update="updateTask"
                @addStatus="addStatus = $event"
                @removeStatus="removeStatus = $event"
                @remove="AddandRemoveTask"
            />
        </div>
    </div>
</template>

<script>
import Tutorial from "./Tutorial/Tutorial.vue";
import Task from "./Task/Task.vue";
import { mapState } from "vuex";

export default {
    components: {
        Tutorial,
        Task
    },
    props: {
        initialTutorials: {
            type: Array,
            default: []
        },
        initialTasks: {
            type: Array,
            default: []
        },
        initialTutorialId: {
            type: Number
        }
    },
    data() {
        return {
            updateStatus: 0,
            addStatus: 0,
            removeStatus: 0,
            status: { "1": "計画中", "2": "学習中", "3": "完了" }
        };
    },
    created: function() {
        this.$store.dispatch("tutorial/initiallist", this.initialTutorials);
        this.$store.dispatch(
            "tutorial/initialTutorialId",
            this.initialTutorialId
        );
        this.$store.dispatch("task/initialtask", this.initialTasks);
    },
    computed: {
        ...mapState({
            tasks: state => state.task.tasks,
            tutorials: state => state.tutorial.lists,
            display_tutorial_id: state => state.tutorial.display_tutorial_id,
            display_tutorial_listIndex: state =>
                state.tutorial.display_tutorial_listIndex
        }),
        DisplayTasks: function() {
            return this.tasks.filter(task => {
                return task.tutorial_id === this.display_tutorial_id;
            });
        }
    },
    methods: {
        updateTask: function(event) {
            if (event.oldIndex !== event.newIndex) {
                this.$store.dispatch("task/updateTask", {
                    tasks: this.tasks,
                    oldIndex: event.oldIndex,
                    newIndex: event.newIndex,
                    id: this.DisplayTasks[this.updateStatus - 1]["tasks"][
                        event.newIndex
                    ].id,
                    displayTutorialId: this.display_tutorial_id,
                    status: this.updateStatus
                });
            }
        },
        AddandRemoveTask: function(event) {
            this.$store.dispatch("task/updateTask", {
                tasks: this.tasks,
                oldIndex: event.oldIndex,
                newIndex: event.newIndex,
                id: this.DisplayTasks[this.addStatus - 1]["tasks"][
                    event.newIndex
                ].id,
                displayTutorialId: this.display_tutorial_id,
                addStatus: this.addStatus,
                removeStatus: this.removeStatus
            });
        },
        updateTutorialStatus: function(status) {
            this.$store.dispatch("tutorial/updateTutorialStatus", {
                status: status,
                id: this.display_tutorial_id,
                listIndex: this.display_tutorial_listIndex
            });
        }
    }
};
</script>
