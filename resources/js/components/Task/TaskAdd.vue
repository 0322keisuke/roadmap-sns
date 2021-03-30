<template>
    <form :class="classList" @submit.prevent="addTaskToList">
        <input
            v-model="name"
            type="text"
            class="text-input"
            placeholder="タスクを追加"
            @focusin="startEditing"
            @focusout="finishEditing"
        />
        <single-submit-button
            :onclick="doSomething"
            type="submit"
            class="text-white border-0 rounded-pill"
            :class="[nameExists ? 'teal sccent-4' : 'stylish-color']"
            v-if="isEditing || nameExists"
        >
            タスクを追加
        </single-submit-button>
    </form>
</template>
<script>
import { mapState } from "vuex";
import SingleSubmitButton from "../SingleSubmitButton";
export default {
    components: {
        SingleSubmitButton
    },
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
            console.log("addTaskToList");
            this.$store.dispatch("task/addtask", {
                name: this.name,
                status: this.status,
                tutorial_id: this.display_tutorial_id
            });
            this.name = "";
        },
        doSomething(event) {
            event.preventDefault();
            return new Promise(resolve => {
                setTimeout(() => {
                    console.log(`Submitted at ${new Date()}`);
                    resolve();
                }, 1000);
            });
        }
    }
};
</script>
