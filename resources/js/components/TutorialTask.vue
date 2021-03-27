<template>
    <div>
        <tutorial :initialTutorials="initialTutorials" />

        <div class="row mt-2">
            <task
                v-for="task in DisplayTasks"
                :key="task.id"
                :title="task.title"
                :status="task.status"
                :displayTasks="task.tasks"
                @change="movingTask"
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
    mounted: function() {
        this.$store.dispatch(
            "tutorial/initialTutorialId",
            this.initialTutorialId
        );
        this.$store.dispatch("task/initialtask", this.initialTasks);
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
        }
    },
    methods: {
        movingTask: function() {
            this.$store.dispatch("task/updateTask", { tasks: this.tasks });
        }
    }
};
</script>
