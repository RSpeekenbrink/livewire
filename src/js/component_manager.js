import store from './store'
import Component from "./component";
import TreeWalker from './dom/tree_walker'
import LivewireElement from "./dom/element";
import NodeInitializer from "./node_initializer";

export default class ComponentManager {
    constructor(connection) {
        this.connection = connection
        this.nodeInitializer = new NodeInitializer
    }

    mount() {
        LivewireElement.rootComponentElementsWithNoParents().forEach(el => {
            store.addComponent(
                new Component(el, this.nodeInitializer, this.connection)
            )
        })
    }

    destroy() {
        store.wipeComponents()
    }
}