<template>
    <div>
        <tutorial />

        <div
            class="d-flex flex-wrap align-items-center mt-2"
            v-if="DisplayTasks.length"
        >
            <div class="d-flex align-items-center">
                <div>教材の学習状況:</div>
                <div class="dropdown mr-3">
                    <button
                        class="btn btn-info dropdown-toggle"
                        type="button"
                        id="dropdownMenu"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                    >
                        {{
                            status[tutorials[display_tutorial_listIndex].status]
                        }}
                    </button>
                    <div
                        class="dropdown-menu mr-5"
                        aria-labelledby="dropdownMenu"
                    >
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
                            v-if="!CheckingDoneTask"
                            class="dropdown-item"
                            type="button"
                            disabled
                        >
                            完了(全タスクをDoneに移動すると選択できます。)
                        </button>
                        <button
                            v-if="CheckingDoneTask"
                            class="dropdown-item"
                            type="button"
                            @click="updateTutorialStatus(3)"
                            data-toggle="modal"
                            data-target="#modal1"
                        >
                            完了
                        </button>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-fill align-items-center mt-2">
                <div>学習の進捗率</div>
                <div class="progress ml-2 flex-fill">
                    <div
                        v-if="DisplayTasks[0].tasks.length"
                        class="progress-bar"
                        :style="{ width: TodoProgress + '%' }"
                        role="progressbar"
                        :aria-valuenow="TodoProgress"
                        aria-valuemin="0"
                        aria-valuemax="100"
                    >
                        Todo:{{ TodoProgress }}%
                    </div>
                    <div
                        v-if="DisplayTasks[1].tasks.length"
                        class="progress-bar bg-warning"
                        :style="{ width: DoingProgress + '%' }"
                        role="progressbar"
                        :aria-valuenow="DoingProgress"
                        aria-valuemin="0"
                        aria-valuemax="100"
                    >
                        Doing:{{ DoingProgress }}%
                    </div>
                    <div
                        v-if="DisplayTasks[2].tasks.length"
                        class="progress-bar bg-success"
                        :style="{ width: DoneProgress + '%' }"
                        role="progressbar"
                        :aria-valuenow="DoingProgress"
                        aria-valuemin="0"
                        aria-valuemax="100"
                    >
                        Done:{{ DoneProgress }}%
                    </div>
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

        <div
            class="modal fade"
            id="modal1"
            tabindex="-1"
            role="dialog"
            aria-labelledby="label1"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="label1">
                            学習お疲れ様でした！
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>＜勇気がでる名言＞</p>
                        {{ finishComment[finishCommentNumber] }}
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                        >
                            閉じる
                        </button>
                    </div>
                </div>
            </div>
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
            status: { "1": "計画中", "2": "学習中", "3": "完了" },
            finishComment: [
                "Stay hungry. Stay foolish. -スティーブ・ジョブズ-",
                "天才とは努力する凡才のことである。-アインシュタイン-",
                "いいんだ。岡本太郎の責任でやるんだから。-岡本太郎-",
                "特別なことをするために特別なことをするのではない、特別なことをするために普段どおりの当たり前のことをする -イチロー-",
                "どんなに悔いても過去は変わらない。どれほど心配したところで未来もどうなるものでもない。いま、現在に最善を尽くすことである。-松下幸之-",
                "そのことはできる、それをやる、と決断せよ。それからその方法を見つけるのだ。-エイブラハム・リンカーン-",
                "目標を達成するには、全力で取り組む以外に方法はない。そこに近道はない。-マイケル・ジョーダン-"
            ],
            finishCommentNumber: 0
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
        },
        CheckingDoneTask: function() {
            const count_todo_task = this.DisplayTasks[0].tasks.length;
            const count_doing_task = this.DisplayTasks[1].tasks.length;
            const count_done_task = this.DisplayTasks[2].tasks.length;

            const count_all_task =
                count_todo_task + count_doing_task + count_done_task;

            if (count_all_task == 0) return false;
            return count_all_task == count_done_task ? true : false;
        },
        TodoProgress: function() {
            const count_todo_task = this.DisplayTasks[0].tasks.length;
            const count_doing_task = this.DisplayTasks[1].tasks.length;
            const count_done_task = this.DisplayTasks[2].tasks.length;

            const count_all_task =
                count_todo_task + count_doing_task + count_done_task;

            if (!count_all_task) return 0;
            return Math.round((count_todo_task / count_all_task) * 100);
        },
        DoingProgress: function() {
            const count_todo_task = this.DisplayTasks[0].tasks.length;
            const count_doing_task = this.DisplayTasks[1].tasks.length;
            const count_done_task = this.DisplayTasks[2].tasks.length;

            const count_all_task =
                count_todo_task + count_doing_task + count_done_task;

            if (!count_all_task) return 0;
            return Math.round((count_doing_task / count_all_task) * 100);
        },
        DoneProgress: function() {
            const count_todo_task = this.DisplayTasks[0].tasks.length;
            const count_doing_task = this.DisplayTasks[1].tasks.length;
            const count_done_task = this.DisplayTasks[2].tasks.length;

            const count_all_task =
                count_todo_task + count_doing_task + count_done_task;

            if (!count_all_task) return 0;
            return Math.round((count_done_task / count_all_task) * 100);
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
            this.finishCommentNumber = Math.floor(
                Math.random() * this.finishComment.length
            );

            this.$store.dispatch("tutorial/updateTutorialStatus", {
                status: status,
                id: this.display_tutorial_id,
                listIndex: this.display_tutorial_listIndex
            });
        }
    }
};
</script>
