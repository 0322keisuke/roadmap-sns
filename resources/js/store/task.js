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
    setTask(state, payload) {
        state.tasks = payload;
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
    setTask(context, payload) {
        context.commit("setTask", payload);
    }
};

const getters = {
    Todo: state =>
        state.tasks.filter(function(task) {
            return task.status === 1;
        }),
    Doing: state =>
        state.tasks.filter(function(task) {
            return task.status === 2;
        }),
    Done: state =>
        state.tasks.filter(function(task) {
            return task.status === 3;
        })
};

export default {
    namespaced: true,
    state,
    mutations,
    actions,
    getters
};
