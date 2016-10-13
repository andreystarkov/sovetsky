import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import { browserHistory } from 'react-router'
import { Provider } from 'react-redux'
import { Router, Route, IndexRoute } from 'react-router'
import configureStore from './store/configureStore'
import Root from './containers/Root'
import PostsContainer from './containers/PostsContainer'
import PostContainer from './containers/PostContainer'
import AboutPageContainer from './containers/AboutPageContainer'
import MainPage from './components/MainPage'
import InteriorPage from './components/InteriorPage'
import MenuPage from './components/MenuPage'

import '../sass/bootstrap.css'
import '../sass/bootstrap-blog.css'

import '../resources/fonts/flaticon.css'
import '../resources/fonts/styles.css'
import '../less/styles.less'

const store = configureStore();
let rootElement = document.getElementById('root');

ReactDOM.render(
    <Provider store={store}>
        <Router history={browserHistory}>
            <Route path="/" component={Root}>
                <IndexRoute component={MainPage} />
                <Route path="about" component={AboutPageContainer} />
            </Route>
        	<Route path="/interior" component={InteriorPage} />
          <Route path="/delivery" component={MenuPage} />
        </Router>

    </Provider>,
    rootElement
);

