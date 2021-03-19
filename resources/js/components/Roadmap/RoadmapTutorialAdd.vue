<template>
    <form :class="classList" @submit.prevent="addList">
        <input
            v-model="title"
            type="test"
            class="text-input"
            placeholder="新しい教材名を入力"
            @focusin="startEditing"
            @focusout="finishEditing"
        />
        <button
            type="submit"
            class="text-white border-0 rounded-pill m-1"
            :class="[titleExists ? 'teal accent-4' : 'stylish-color']"
            v-if="isEditing || titleExists"
        >
            教材を追加
        </button>
    </form>
</template>

<script>
export default {
    data: function() {
        return {
            title: "",
            isEditing: false
        };
    },
    computed: {
        classList() {
            const classList = ["addlist"];
            if (this.isEditing) {
                classList.push("active");
            }
            return classList;
        },

        titleExists() {
            return this.title.length > 0;
        }
    },

    methods: {
        async addList() {
            await this.$store.dispatch("roadmap/addlist", {
                title: this.title
            });
            this.title = "";
        },
        startEditing() {
            this.isEditing = true;
        },
        finishEditing() {
            this.isEditing = false;
        }
    }
};
</script>
