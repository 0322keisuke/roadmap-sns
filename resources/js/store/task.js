const state = {
    tasks: []
};

const mutations = {
    initialtask(state, payload) {
        state.tasks = payload;
    },
    addtask(state, payload) {
        state.tasks = payload.tasks;
    },
    removeTask(state, payload) {
        state.tasks = payload.tasks;
    },
    updateTask(state, payload) {
        state.tasks = payload.tasks;
    }
};

const actions = {
    async initialtask(context, payload) {
        await context.commit("initialtask", payload);
    },
    async addtask(context, payload) {
        const response = await axios.post("/tasks/store", payload);
        context.commit("addtask", response.data);
    },
    async removeTask(context, payload) {
        const response = await axios.delete(
            `/tasks/${payload.id}/destroy`,
            payload
        );

        context.commit("removeTask", response.data);
    },
    async updateTask(context, payload) {
        await axios.patch("/tasks/update", payload);

        context.commit("updateTask", payload);
    }
};

export default {
    namespaced: true,
    state,
    mutations,
    actions
};
