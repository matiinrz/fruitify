import {defineStore} from 'pinia'

export const useStorage = defineStore("storage", {
    state: () => ({
        storeLists: []
    }),
    actions: {
        setLists(list: any) {
            localStorage.lists.push(list)
        }
    },
    getters: {},

    hydrate(state, initialState) {
        state.storeLists = localStorage.lists
    }
})