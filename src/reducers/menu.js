import { RECEIVE_MENU_ITEMS } from '../actions';

const defaultState = {
    items: []
};

export default function posts(state = defaultState, action) {
    switch(action.type) {
        case RECEIVE_MENU_ITEMS:
            const { menu } = action.payload;

           // console.log( 'RECEIVE_MENU_ITEMS', menu);

            return Object.assign({}, state, {
                items: menu
            });

        default:
            return state;
    }

}
