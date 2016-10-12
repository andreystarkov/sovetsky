import { RECEIVE_SLIDER_MAIN } from '../actions';

const defaultState = {
    main: []
};

export default function slider(state = defaultState, action) {
    switch(action.type) {
        case RECEIVE_SLIDER_MAIN:
            const { main } = action.payload;

            console.log('RECEIVE_SLIDER_MAIN: ', main);

            return Object.assign({}, state, {
                main: main
            });
        default:
            return state;
    }

}
