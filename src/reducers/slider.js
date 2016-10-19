import { RECEIVE_SLIDER_MAIN, RECEIVE_SLIDER_INTERIOR } from '../actions'

const defaultState = {
    main: [],
    interior: []
};

export default function slider(state = defaultState, action) {
    switch(action.type) {
        case RECEIVE_SLIDER_MAIN:
            const { main } = action.payload;

          //  console.log('RECEIVE_SLIDER_MAIN: ', main);

            return Object.assign({}, state, {
                main: main
            });
        case RECEIVE_SLIDER_INTERIOR:
            const { interior } = action.payload;

          //  console.log('RECEIVE_SLIDER_INTERIOR: ', interior);

            return Object.assign({}, state, {
                interior: interior
            });
        default:
            return state;
    }

}
