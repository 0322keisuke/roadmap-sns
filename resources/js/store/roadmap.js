const state = {
    lists: [],
    editable: false
};

const mutations = {
    initiallist(state, payload) {
        state.lists = payload;
    },
    addlist(state, payload) {
        state.lists.push({ title: payload.title, tasks: [] });
    },
    removeTutorial(state, payload) {
        state.lists.splice(payload.listIndex, 1);
    },
    addtask(state, payload) {
        state.lists[payload.listIndex].tasks.push(payload.name);
    },
    removeTask(state, payload) {
        state.lists[payload.listIndex].tasks.splice(payload.taskIndex, 1);
    },
    setEditable(state, payload) {
        state.editable = payload;
    }
};

const actions = {
    initiallist(context, payload) {
        context.commit("initiallist", payload);
    },
    addlist(context, payload) {
        context.commit("addlist", payload);
    },
    removeTutorial(context, payload) {
        context.commit("removeTutorial", payload);
    },
    addtask(context, payload) {
        context.commit("addtask", payload);
    },
    removeTask(context, payload) {
        context.commit("removeTask", payload);
    },
    setEditable(context, payload) {
        context.commit("setEditable", payload);
    }
};

export default {
    namespaced: true,
    state,
    mutations,
    actions
};
