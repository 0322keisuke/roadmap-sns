<template>
    <form :class="classList" @submit.prevent="addTaskToList">
        <input
            v-model="name"
            type="text"
            class="text-input"
            placeholder="タスクを追加"
            pattern=".*\S+.*"
            required
            @focusin="startEditing"
            @focusout="finishEditing"
        />
        <div class="m-1">
            <button
                type="submit"
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
export default {
    props: {
        listIndex: {
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
        }
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

            this.$store.dispatch("roadmap/addtask", {
                name: this.name,
                listIndex: this.listIndex
            });
            this.name = "";
        }
    }
};
</script>
