<template>
    <div class="tutorial-list align-top mr-3">
        <div class="bg-primary border p-2 text-white position-relative">
            <div class="m-1 pr-5 text-nowrap">
                教材{{ listIndex + 1 }}：{{ title }}
            </div>
            <div class="deletelist" @click="removeTutorial">×</div>
        </div>

        <roadmap-task
            v-for="(task, index) in tasks"
            :name="task"
            :key="task.id"
            :listIndex="listIndex"
            :taskIndex="index"
        />

        <div class="m-1">
            <roadmap-task-add :listIndex="listIndex" />
        </div>
    </div>
</template>

<script>
import RoadmapTask from "./RoadmapTask";
import RoadmapTaskAdd from "./RoadmapTaskAdd";

export default {
    components: {
        RoadmapTask,
        RoadmapTaskAdd
    },
    props: {
        title: {
            type: String,
            required: true
        },
        tasks: {
            type: Array,
            required: true
        },
        listIndex: {
            type: Number,
            required: true
        }
    },
    methods: {
        removeTutorial: function() {
            if (confirm("本当にこの教材を削除しますか？")) {
                this.$store.dispatch("roadmap/removeTutorial", {
                    listIndex: this.listIndex
                });
            }
        }
    }
};
</script>
