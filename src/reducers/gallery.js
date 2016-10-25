import { RECEIVE_GALLERY_ITEMS } from '../actions';

const defaultState = {
    items: []
};

export default function posts(state = defaultState, action) {
    switch(action.type) {
        case RECEIVE_GALLERY_ITEMS:
            const { gallery } = action.payload;

            //console.log( 'RECEIVE_GALLERY_ITEMS', gallery);

            return Object.assign({}, state, {
                items: gallery
            });

        default:
            return state;
    }

}
