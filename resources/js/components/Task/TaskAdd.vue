<template>
    <form :class="classList">
        <input
            v-model="name"
            type="text"
            class="text-input"
            placeholder="タスクを追加"
            @focusin="startEditing"
            @focusout="finishEditing"
        />
        <div class="m-1">
            <button
                @click.prevent="addTaskToList"
                class="text-white border-0 rounded-pill"
                :class="[nameExists ? 'teal sccent-4' : 'stylish-color']"
                v-if="isEditing || nameExists"
            >
                タスクを追加
            </button>
        </div>
    </form>
</template>
<script>
import { mapState } from "vuex";
export default {
    props: {
        status: {
            type: Number,
            required: true
        }
    },
    data: function() {
        return {
            name: "",
            isEditing: false
        };
    },
    computed: {
        classList() {
            const classList = ["addtask"];
            if (this.isEditing) {
                classList.push("active");
            }
            return classList;
        },
        nameExists() {
            return this.name.length > 0;
        },
        ...mapState({
            display_tutorial_id: state => state.tutorial.display_tutorial_id
        })
    },
    methods: {
        startEditing: function() {
            this.isEditing = true;
        },
        finishEditing: function() {
            this.isEditing = false;
        },
        addTaskToList: function() {
            if (!this.name) return;

            this.$store.dispatch("task/addtask", {
                name: this.name,
                status: this.status,
                tutorial_id: this.display_tutorial_id
            });
            this.name = "";
        }
    }
};
</script>
