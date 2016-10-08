import { combineReducers } from 'redux';
import pages from './pages';
import posts from './posts';
import menus from './menus';
import interior from './interior';

// TODO: try to import * from './' instead of importing individual reducers

const rootReducer = combineReducers({
    pages,
    posts,
    menus,
    interior
});

export default rootReducer;
