import { RECEIVE_MENUS } from '../actions';
//import { pushStorage } from '../etc'
const defaultState = {
    menus: []
};

export default function menus(state = defaultState, action) {

    console.log( 'menus call: ', action.type);

    switch(action.type) {
        case RECEIVE_MENUS:
            const { menus } = action.payload;

          //  if( menus ) pushStorage('nav', menus.items);

            return Object.assign({}, state, {
                menus: menus
            });

        default:
            return state;
    }

}
