import { RECEIVE_MENUS } from '../actions';

const defaultState = {
    menus: []
};

export default function menus(state = defaultState, action) {

    console.log( 'menus call: ', action.type);

    switch(action.type) {
        case RECEIVE_MENUS:
            const { menus } = action.payload;

            console.log('AAAAAAAAA: ', action, state);

            return Object.assign({}, state, {
                menus: menus
            });

        default:
            return state;
    }

}
