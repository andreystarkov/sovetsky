import { RECEIVE_INTERIOR, RECEIVE_INTERIOR_MAIN } from '../actions';
import Immutable from 'immutable';

const defaultState = {
    interior: [],
    main: []
};

export default function interior(state = defaultState, action) {
    switch(action.type) {
        case RECEIVE_INTERIOR:
            const { interior } = action.payload;

           // console.log('RECEIVE_INTERIOR: ', action.payload)

            return Object.assign({}, state, {
                interior: interior
            });
        case RECEIVE_INTERIOR_MAIN:
            const { interiorMain } = action.payload;

           // console.log('RECEIVE_INTERIOR_MAIN:', interiorMain)

            return Object.assign({}, state, {
                main: interiorMain
            });

        default:
            return state;
    }

}
