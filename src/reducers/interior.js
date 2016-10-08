import { RECEIVE_INTERIOR } from '../actions';

const defaultState = {
    interior: []
};

export default function interior(state = defaultState, action) {
    switch(action.type) {
        case RECEIVE_INTERIOR:
            const { interior } = action.payload;

            console.log('interior reducer: ', action.payload)

            return Object.assign({}, state, {
                interior: interior
            });

        default:
            return state;
    }

}
